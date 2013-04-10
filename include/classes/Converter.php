<?php
class Converter {

    private $itemsPerRun;
    private $start;
    private $oldStats;

    private $oldDB;
    private $newDB;


    function __construct(fDatabase $oldDB, fDatabase $newDB, $start = 0, $itemsPerRun = 120) {
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
            case 'blocks':
                $this->convertBlocks();
                $cur = $this->oldStats['total_blocks'];
                break;
            case 'items':
                $this->convertItems();
                $cur = $this->oldStats['total_items'];
                break;
            case 'server':
                $this->convertServerStats();
                $cur = 4;
                break;
        }

        return round(fSession::get('converter[last_start]') / $cur * 100, 0);
    }

    private function convertPlayers() {
        $result = $this->oldDB->query('
                        SELECT
                        player_name,
                        firstever_login,
                        last_login,
                        num_logins,
                        last_logout,
                        num_secs_loggedon,
                        distance_traveled AS total,
                        distance_traveled_in_minecart AS minecart,
                        distance_traveled_in_boat AS boat,
                        distance_traveled_on_pig AS pig
                        FROM players
                        WHERE last_logout IS NOT NULL
                        AND last_login IS NOT NULL
                        GROUP BY player_name
                        HAVING COUNT(1) = 1
                        LIMIT %i,%i
                        ', $this->start, $this->itemsPerRun);

        $player_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_players" ("name", "first_login", "logins", "login_time", "playtime")
                            VALUES (%s, %i, %i, %i, %i)
                            ');
        $login_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_detailed_log_players" ("player_id", "time", "is_login")
                            VALUES (%i, %i, %i)
                            ');
        $dist_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_distances"
                            ("player_id",
                            "foot",
                            "boat",
                            "minecart",
                            "pig")
                            VALUES (%i, %i, %i, %i, %i)
                            ');

        $i = $this->start;
        foreach($result as $row) {
            $last = $this->newDB->query(
                $player_stmt,
                $row['player_name'],
                $row['firstever_login'],
                $row['num_logins'],
                $row['last_login'],
                $row['num_secs_loggedon']
            )->getAutoIncrementedValue();
            $foot = $row['total'] - ($row['minecart'] + $row['boat'] + $row['pig']);
            $this->newDB->execute($dist_stmt, $last, $foot, $row['boat'], $row['minecart'], $row['pig']);
            $this->newDB->execute($login_stmt, $last, $row['last_login'], 1);
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
                            VALUES (%s, %i, %i, %i)
        ');
        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['killer'])->fetchScalar();
                $victim_id = $this->newDB->query($id_stmt, $row['victim'])->fetchScalar();
                $this->newDB->execute($pvp_stmt, $this->mapMaterialIds($row['material']) . ':0',
                                      $player_id,
                                      $victim_id,
                                      $row['times']);
            } catch(fSQLException $e) {
                fCore::debug('convertPVP:' . $e->getMessage());
            } catch(fNoRowsException $e) {
                fCore::debug('convertPVP:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
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
                            VALUES (%s, %i, %i, %i)
        ');

        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['killer'])->fetchScalar();
                $this->newDB->execute($pve_stmt, $this->mapMaterialIds($row['material']) . ':0',
                                      $this->mapEntityIds($row['creature']),
                                      $player_id,
                                      $row['times']);
            } catch(fSQLException $e) {
                fCore::debug('convertPVE:' . $e->getMessage());
            } catch(fNoRowsException $e) {
                fCore::debug('convertPVE:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
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
                                VALUES (%s, %i, %i, %i)
        ');
        $evp_stmt_update = $this->newDB->translatedPrepare('
                                UPDATE "prefix_total_pve_kills" SET
                                "player_killed" = %i
                                WHERE "player_id" = %i
                                AND "entity_id" = %i
                                AND "material_id" = %s
         ');
        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['victim'])->fetchScalar();
                $count = $this->newDB->query($evp_stmt_update, $row['times'], $player_id,
                                             $this->mapEntityIds($row['creature']),
                                             $this->mapMaterialIds($row['material']) . ':0')->countAffectedRows();

                if($count <= 0) {
                    $this->newDB->execute($evp_stmt_new, $row['material'] . ':0', $this->mapEntityIds($row['creature']),
                                          $player_id,
                                          $row['times']);
                }
            } catch(fSQLException $e) {
                fCore::debug('convertEVP:' . $e->getMessage());
            } catch(fNoRowsException $e) {
                fCore::debug('convertEVP:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertDeaths() {
        $result = $this->oldDB->query('
                            SELECT player_name AS player, kill_type AS cause, COUNT(kill_type) AS times
                            FROM kills
                            INNER JOIN players p1 ON kills.killed_uuid = p1.uuid
                            WHERE killed = 999
                            AND (killed_by = 18 OR killed_by = 0)
                            GROUP BY player_name, kill_type
                            LIMIT %i,%i
                            ', $this->start, $this->itemsPerRun);
        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $death_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_total_deaths"
                            ("player_id",
                            "cause",
                            "times")
                            VALUES (%i, %s, %i)
        ');

        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['player'])->fetchScalar();
                $this->newDB->execute($death_stmt, $player_id, $this->mapDeathType($row['cause']), $row['times']);
            } catch(fNoRowsException $e) {
                fCore::debug('convertDeaths:' . $e->getMessage());
            } catch(fSQLException $e) {
                fCore::debug('convertDeaths:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertBlocks() {
        $result = $this->oldDB->query('
                            SELECT block_id, num_destroyed, num_placed, player_name AS player
                            FROM blocks
                            INNER JOIN players p1 ON blocks.uuid = p1.uuid
                            GROUP BY player_name, block_id
                            LIMIT %i,%i
                            ', $this->start, $this->itemsPerRun);
        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $block_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_total_blocks"
                            ("player_id",
                            "material_id",
                            "destroyed",
                            "placed")
                            VALUES (%i, %s, %i, %i)
        ');

        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['player'])->fetchScalar();
                $this->newDB->query($block_stmt, $player_id, $this->mapMaterialIds($row['block_id']) . ':0', $row['num_destroyed'],
                                    $row['num_placed']);
            } catch(fNoRowsException $e) {
                fCore::debug('convertBlocks:' . $e->getMessage());
            } catch(fSQLException $e) {
                fCore::debug('convertBlocks:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertItems() {
        $result = $this->oldDB->query('
                            SELECT item, num_pickedup, num_dropped, player_name AS player
                            FROM pickup_drop
                            INNER JOIN players p1 ON pickup_drop . uuid = p1 . uuid
                            GROUP BY player_name, item
                            LIMIT %i,%i
                            ', $this->start, $this->itemsPerRun);
        $id_stmt = $this->newDB->translatedPrepare('
                            SELECT player_id
                            FROM "prefix_players"
                            WHERE "name" = %s
        ');
        $item_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_total_items"
                            ("player_id",
                            "material_id",
                            "dropped",
                            "picked_up")
                            VALUES (%i, %s, %i, %i)
        ');

        $i = $this->start;
        foreach($result as $row) {
            try {
                $player_id = $this->newDB->query($id_stmt, $row['player'])->fetchScalar();
                $this->newDB->query($item_stmt, $player_id, $this->mapMaterialIds($row['item']) . ':0', $row['num_dropped'],
                                    $row['num_pickedup']);
            } catch(fNoRowsException $e) {
                fCore::debug('convertItems:' . $e->getMessage());
            } catch(fSQLException $e) {
                fCore::debug('convertItems:' . $e->getMessage());
            }
            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertServerStats() {
        $row = $this->oldDB->query('
                            SELECT * FROM server;
        ')->fetchRow();

        foreach($row as $key => $value) {
            try {
                switch($key) {
                    case 'startup_time':
                        $name = 'last_startup';
                        break;
                    case 'shutdown_time':
                        $name = 'last_shutdown';
                        break;
                    case 'max_players_ever_online':
                        $name = 'max_players_online';
                        break;
                    case 'max_players_ever_online_time':
                        $name = 'max_players_online_time';
                        break;
                    default:
                        $name = '';
                }
                if($name != '') {
                    $this->newDB->execute('
                            UPDATE "prefix_server_statistics" SET
                            "value" = %i
                            WHERE "key" = %s
                            ', $value, $name);
                }
            } catch(fNoRowsException $e) {
                fCore::debug('convertServerStats:' . $e->getMessage());
            } catch(fSQLException $e) {
                fCore::debug('convertServerStats:' . $e->getMessage());
            }
            fSession::set('converter[last_start]', 4);
        }
    }

    private function mapMaterialIds($oldId) {
        switch($oldId) {
            case 9000:
                return -1;
            case 9001:
                return 0;
            default:
                return $oldId;
        }
    }

    private function mapDeathType($oldId) {
        switch($oldId) {
            case 1:
                return "BLOCK_EXPLOSION";
            case 2:
                return "DROWNING";
            case 3:
                return "ENTITY_EXPLOSION";
            case 4:
                return "FALL";
            case 5:
                return "FIRE";
            case 6:
                return "FIRE_TICK";
            case 7:
                return "VOID";
            case 8:
                return "SUFFOCATION";
            case 9:
                return "LIGHTNING";
            case 10:
                return "LAVA";
            case 11:
                return "CONTACT";
            case 12:
                return "ENTITY_ATTACK";
            case 13:
                return "CUSTOM";
            case 14:
                return "SUICIDE";
            case 15:
                return "STARVATION";
            case 16:
                return "POISON";
            case 17:
                return "MAGIC";
            case 18:
                return "MELTING";
            case 19:
                return "WITHER";
            case 20:
                return "FALLING_BLOCK";

            default:
                return "CUSTOM";
        }
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
                            SELECT kills . id FROM kills
                            INNER JOIN players p1 ON kills . killed_by_uuid = p1 . uuid
                            INNER JOIN players p2 ON kills . killed_uuid = p2 . uuid
                            WHERE kills . killed = 999
                                  AND kills . killed_by = 999
                            GROUP BY kills . killed_by_uuid, kills . killed_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_pvp_kills]', $count);

            // player killed creature
            $count = $this->oldDB->query('
                            SELECT id FROM kills
                            INNER JOIN players p1 ON kills . killed_by_uuid = p1 . uuid
                            WHERE killed != 18
                                  AND killed != 0
                                      AND killed != 999
                                          AND killed_by = 999
                            GROUP BY kills . killed, kills . killed_by_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_pve_kills]', $count);

            // creature killed player
            $count = $this->oldDB->query('
                            SELECT id FROM kills
                            INNER JOIN players p1 ON kills . killed_uuid = p1 . uuid
                            WHERE killed = 999
                                  AND killed_by != 999
                                      AND killed_by != 18
                                          AND killed_by != 0
                            GROUP BY kills . killed_by, kills . killed_uuid
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_evp_kills]', $count);

            // player death causes
            $count = $this->oldDB->query('
                            SELECT id
                            FROM kills
                            INNER JOIN players p1 ON kills . killed_uuid = p1 . uuid
                            WHERE killed = 999
                                  AND (killed_by = 18 OR killed_by = 0)
                            GROUP BY player_name, kill_type
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_deaths]', $count);

            // total blocks
            $count = $this->oldDB->query('
                            SELECT block_id
                            FROM blocks
                            INNER JOIN players p1 ON blocks . uuid = p1 . uuid
                            GROUP BY player_name, block_id
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_blocks]', $count);

            // total items
            $count = $this->oldDB->query('
                            SELECT item
                            FROM pickup_drop
                            INNER JOIN players p1 ON pickup_drop . uuid = p1 . uuid
                            GROUP BY player_name, item
                            ')
                ->countReturnedRows();
            fSession::set('converterStats[total_items]', $count);
        }
        $this->oldStats = fSession::get('converterStats');

        return $this->oldStats;
    }

}
