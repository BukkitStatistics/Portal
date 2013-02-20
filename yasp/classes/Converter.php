<?php
class Converter {

    private $itemsPerRun;
    private $start;
    private $oldStats;

    private $oldDB;
    private $newDB;


    function __construct(fDatabase $oldDB, fDatabase $newDB, $start = 0, $itemsPerRun = 100) {
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
                $this->convertBlocks();
                $cur = $this->oldStats['total_blocks_placed'];
                break;
            case 'items_dropped':
                $this->convertItems();
                $cur = $this->oldStats['total_items_dropped'];
                break;
            case 'blocks_destroyed':
                $this->convertBlocks();
                $cur = $this->oldStats['total_blocks_destroyed'];
                break;
            case 'items_picked':
                $this->convertItems();
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
                            INSERT INTO "prefix_detailed_players_log" ("player_id", "logged_in", "logged_out")
                            VALUES (%i, %i, %i)
                            ');
        $dist_stmt = $this->newDB->translatedPrepare('
                            INSERT INTO "prefix_players_distance"
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

            $i++;
            fSession::set('converter[last_start]', $i);
        }
    }

    private function convertPVE() {

    }

    private function convertPVP() {

    }

    private function convertEVP() {

    }

    private function convertDeaths() {

    }

    private function convertBlocks() {

    }

    private function convertItems() {

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
                            SELECT COUNT(kills.id) FROM kills
                            INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                            INNER JOIN players p2 ON kills.killed_uuid = p2.uuid
                            WHERE kills.killed = 999
                            AND kills.killed_by = 999
                            ')
                ->fetchScalar();
            fSession::set('converterStats[total_pvp_kills]', $count);

            // player killed creature
            $count = $this->oldDB->query('
                            SELECT COUNT(id) FROM kills
                            INNER JOIN players p1 ON kills.killed_by_uuid = p1.uuid
                            WHERE killed != 18
                            AND killed != 0
                            AND killed != 999
                            AND killed_by = 999
                            ')
                ->fetchScalar();
            fSession::set('converterStats[total_pve_kills]', $count);

            // creature killed player
            $count = $this->oldDB->query('
                            SELECT COUNT(id) FROM kills
                            INNER JOIN players p1 ON kills.killed_uuid = p1.uuid
                            WHERE killed = 999
                            AND killed_by != 999
                            AND killed_by != 18
                            AND killed_by != 0
                            ')
                ->fetchScalar();
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
