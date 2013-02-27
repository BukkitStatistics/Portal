<?php
class Converter {

    private $itemsPerRun;
    private $start;
    private $oldStats;

    private $oldDB;
    private $newDB;


    function __construct(fDatabase $oldDB, fDatabase $newDB, $start = 0, $itemsPerRun = 100) {
        // TODO: reset db before performing update...
        $this->oldDB = $oldDB;
        $this->newDB = $newDB;

        $this->itemsPerRun = $itemsPerRun;
        $this->start = $start;
        $this->oldStats = array();
    }

    public function process($type) {
        $cur = 1;
        switch($type) {
            case 'players':
                $this->convertPlayers();
                $cur = $this->oldStats['player_count'];
                break;
            case 'pve':
                $this->convertPVE();
                $cur = $this->oldStats['total_pve_kills'];
                break;
            case 'pvp':
                $this->convertPVP();
                $cur = $this->oldStats['total_pvp_kills'];
                break;
            case 'evp':
                $this->convertEVP();
                $cur = $this->oldStats['total_evp_kills'];
                break;
            case 'deaths':
                $this->convertDeaths();
                $cur = $this->oldStats['total_deaths'];
                break;
            case 'blocks_placed':
                $this->convertBlocks(false);
                $cur = $this->oldStats['total_blocks_placed'];
                break;
            case 'items_dropped':
                $this->convertItems(true);
                $cur = $this->oldStats['total_items_dropped'];
                break;
            case 'blocks_destroyed':
                $this->convertBlocks(true);
                $cur = $this->oldStats['total_blocks_destroyed'];
                break;
            case 'items_picked':
                $this->convertItems(false);
                $cur = $this->oldStats['total_items_picked'];
                break;
        }

        return round(fSession::get('converter[last_start]') / $cur * 100, 0);
    }

    private function convertPlayers() {
        $result = $this->oldDB->query('
                        SELECT
                        DISTINCT player_name,
                        firstever_login,
                        last_login,
                        num_logins,
                        last_logout,
                        distance_traveled AS total,
                        distance_traveled_in_minecart AS minecart,
                        distance_traveled_in_boat AS boat,
                        distance_traveled_on_pig AS pig
                        FROM players
                        WHERE last_logout IS NOT NULL
                        AND last_login IS NOT NULL
                        LIMIT %i,%i
                        ', $this->start, $this->itemsPerRun);

        $player_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_players" ("name", "first_login", "logins")
                            VALUES (%s, %i, %i)
                            ');
        $login_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_detailed_log_players" ("player_id", "time", "is_login")
                            VALUES (%i, %i, %i)
                            ');
        $dist_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_distance_players"
                            ("player_id",
                            "foot",
                            "boat",
                            "minecart",
                            "pig")
                            VALUES (%i, %i, %i, %i, %i)
                            ');

        $i = $this->start;
        foreach($result as $row) {
            $last = $this->newDB->query($player_stmt, $row['player_name'], $row['firstever_login'],
                                        $row['num_logins'])->getAutoIncrementedValue();
            $foot = $row['total'] - ($row['minecart'] + $row['boat'] + $row['pig']);
            $this->newDB->execute($dist_stmt, $last, $foot, $row['boat'], $row['minecart'], $row['pig']);
            $this->newDB->execute($login_stmt, $last, $row['last_login'], $row['last_logout']);
            $this->newDB->execute($login_stmt, $last, $row['last_logout'], 0);

            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertPVP() {
        $result = $this->oldDB->query('
                        SELECT
                            p1.player_name AS killer,
                            p2.player_name AS victim ,
                            kills.killed_using AS material,
                            COUNT(kills.killed_by_uuid) AS times
                        FROM kills
                        INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                        INNER JOIN players p2 ON kills.killed_uuid = p2.uuid
                        WHERE kills.killed = 999
                        AND kills.killed_by = 999
                        GROUP BY kills.killed_by_uuid, kills.killed_uuid
                        ORDER BY p1.player_name
                        LIMIT %i,%i
                        ', $this->start, $this->itemsPerRun);

        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $pvp_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_total_pvp_kills"
                            ("material_id",
                            "player_id",
                            "victim_id",
                            "times")
                            VALUES (%i, %i, %i, %i)
        ');
        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['killer']);
                $victim_id = $this->newDB->query($id_stmt, $row['victim']);
                $this->newDB->execute($pvp_stmt, $row['material'],
                                      $player_id->fetchScalar(),
                                      $victim_id->fetchScalar(),
                                      $row['times']);

                $i++;
                fSession::set('converter[last_start]', $i);
            } catch(fSQLException $e) {
                // if material/player/creature id does not exsist
            }
        }

    }

    private function convertPVE() {
        $result = $this->oldDB->query('
                        SELECT
                            p1.player_name AS killer,
                            kills.killed AS creature,
                            kills.killed_using AS material,
                            COUNT(kills.killed) AS times
                        FROM kills
                        INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                        WHERE killed != 18
                        AND killed != 0
                        AND killed != 999
                        AND killed_by = 999
                        GROUP BY kills.killed, kills.killed_by_uuid
                        ORDER BY p1.player_name
                        LIMIT %i,%i
                        ', $this->start, $this->itemsPerRun);

        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $pve_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_total_pve_kills"
                            ("material_id",
                            "entity_id",
                            "player_id",
                            "creature_killed")
                            VALUES (%i, %i, %i, %i)
        ');

        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['killer']);
                $this->newDB->execute($pve_stmt, $row['material'],
                                      $this->mapEntityIds($row['creature']),
                                      $player_id->fetchScalar(),
                                      $row['times']);

                $i++;
                fSession::set('converter[last_start]', $i);
            } catch(fSQLException $e) {
                // if material/player/creature id does not exsist
            }
        }

    }

    private function convertEVP() {
        $result = $this->oldDB->query('
                        SELECT
                            kills.killed_by AS creature,
                            p1.player_name AS victim ,
                            kills.killed_using AS material,
                            COUNT(kills.killed_uuid) AS times
                        FROM kills
                        INNER JOIN players p1 ON kills.killed_uuid = p1.uuid
                        WHERE killed = 999
                        AND killed_by != 999
                        AND killed_by != 18
                        AND killed_by != 0
                        GROUP BY kills.killed_by, kills.killed_uuid
                        LIMIT %i,%i
                        ', $this->start, $this->itemsPerRun);


        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $evp_stmt_new = $this->newDB->translatedPrepare('
                                INSERT INTO "prefix_total_pve_kills"
                                ("material_id",
                                "entity_id",
                                "player_id",
                                "player_killed")
                                VALUES (%i, %i, %i, %i)
        ');
        $evp_stmt_update = $this->newDB->translatedPrepare('
                                UPDATE "prefix_total_pve_kills" SET
                                "player_killed" = %i
                                WHERE "player_id" = %i
                                AND "entity_id" = %i
                                AND "material_id" = %i
         ');
        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['victim']);
                $count = $this->newDB->query($evp_stmt_update, $row['times'], $player_id,
                                             $this->mapEntityIds($row['creature']),
                                             $row['material'])->countAffectedRows();

                if($count <= 0) {
                    $this->newDB->execute($evp_stmt_new, $row['material'], $this->mapEntityIds($row['creature']),
                                          $player_id->fetchScalar(),
                                          $row['times']);
                }


                $i++;
                fSession::set('converter[last_start]', $i);
            } catch(fSQLException $e) {
                // if material/player/creature id does not exsist
            }
        }
    }

    private function convertDeaths() {

    }

    private function convertBlocks($destroyed) {

    }

    private function convertItems($dropped) {

    }

    private function mapEntityIds($oldId) {
        switch($oldId) {
            case 1:
                return 93;
            case 2:
                return 92;
            case 3:
                return 50;
            case 4:
                return 50;
            case 5:
                return 56;
            case 60:
                return 53;
            case 7:
                return 49;
            case 8:
                return 90;
            case 9:
                return 57;
            case 10:
                return 91;
            case 11:
                return 51;
            case 12:
                return 55;
            case 13:
                return 52;
            case 14:
                return 94;
            case 15:
                return 95;
            case 16:
                return 95;
            case 17:
                return 51;
            case 18:
                return 21;
            case 19:
                return 54;
            case 20:
                return 61;
            case 21:
                return 59;
            case 22:
                return 63;
            case 23:
                return 58;
            case 24:
                return 62;
            case 25:
                return 96;
            case 26:
                return 60;
            case 27:
                return 97;
            case 28:
                return 120;
            case 29:
                return 98;
            case 30:
                return 99;
            default:
                return 1;
        }
    }

    public function getOldStats() {
        if(fSession::get('converterStats') == NULL) {
            fCore::debug('caculating old stats');
            $count = $this->oldDB->query('
                            SELECT COUNT(DISTINCT player_name)
                            FROM players
                            WHERE last_logout IS NOT NULL
                            AND last_login IS NOT NULL
                            ')
                ->fetchScalar();
            fSession::set('converterStats[player_count]', $count);

            // player killed player
            $count = $this->oldDB->query('
                            SELECT kills.id FROM kills
                            INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                            INNER JOIN players p2 ON kills.killed_uuid = p2.uuid
                            WHERE kills.killed = 999
                            AND kills.killed_by = 999
                            GROUP BY kills.killed_by_uuid, kills.killed_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_pvp_kills]', $count);

            // player killed creature
            $count = $this->oldDB->query('
                            SELECT id FROM kills
                            INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                            WHERE killed != 18
                            AND killed != 0
                            AND killed != 999
                            AND killed_by = 999
                            GROUP BY kills.killed, kills.killed_by_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_pve_kills]', $count);

            // creature killed player
            $count = $this->oldDB->query('
                            SELECT id FROM kills
                            INNER JOIN players p1 ON kills.killed_uuid = p1.uuid
                            WHERE killed = 999
                            AND killed_by != 999
                            AND killed_by != 18
                            AND killed_by != 0
                            GROUP BY kills.killed_by, kills.killed_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_evp_kills]', $count);

            // player death causes
            $count = $this->oldDB->query('
                            SELECT COUNT(id) FROM kills
                            INNER JOIN players p1 ON kills.killed_uuid = p1.uuid
                            WHERE killed = 999
                            AND (killed_by = 18 OR killed_by = 0)
                            ')
                ->fetchScalar();
            fSession::set('converterStats[total_deaths]', $count);

            // total blocks destroyed/placed
            $count = $this->oldDB->query('
                            SELECT SUM(num_placed) AS placed, SUM(num_destroyed) AS destroyed
                            FROM blocks
                            INNER JOIN players p1 ON blocks.uuid = p1.uuid
                            ')
                ->fetchRow();
            fSession::set('converterStats[total_blocks_destroyed]', $count['destroyed']);
            fSession::set('converterStats[total_blocks_placed]', $count['placed']);

            // total items dropped/picked
            $count = $this->oldDB->query('
                            SELECT SUM(num_pickedup) AS picked, SUM(num_dropped) AS dropped
                            FROM pickup_drop
                            INNER JOIN players p1 ON pickup_drop.uuid = p1.uuid
                            ')
                ->fetchRow();
            fSession::set('converterStats[total_items_dropped]', $count['dropped']);
            fSession::set('converterStats[total_items_picked]', $count['picked']);
        }
        $this->oldStats = fSession::get('converterStats');

        return $this->oldStats;
    }

}
