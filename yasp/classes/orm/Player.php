<?php
/**
 * This class represents an single player in the players table.
 */
class Player extends fActiveRecord {


    /**
     * Counts all player deaths
     *
     * @return fNumber
     */
    public static function countAllDeaths() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(times)
                        FROM "prefix_total_death_players"
        ');

        try {
            return new fNumber($res->fetchScalar());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }


    /**
     * Counts all the kills of the specified type.
     *
     * @param string $type
     *
     * @return fNumber
     */public static function countAllKillsOfType($type = 'all') {
        if($type == 'pvp')
            $sql = '
                    SELECT SUM(times)
                    FROM "prefix_total_pvp_kills"
            ';
        elseif($type == 'evp')
            $sql = '
                    SELECT SUM(player_killed)
                    FROM "prefix_total_pve_kills"
            ';
        elseif($type == 'pve')
            $sql = '
                    SELECT SUM(creature_killed)
                    FROM "prefix_total_pve_kills"
            ';
        else
            $sql = '
                    SELECT
                      (
                        SELECT SUM(times)
                        FROM "prefix_total_pvp_kills"
                      ) +
                      (
                        SELECT SUM(player_killed)
                        FROM "prefix_total_pve_kills"
                      ) +
                      (
                        SELECT SUM(creature_killed)
                        FROM "prefix_total_pve_kills"
                      )
            ';

        $res = fORMDatabase::retrieve()->translatedQuery($sql);

        try {
            return new fNumber($res->fetchScalar());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }

    /**
     * Counts all player logins
     *
     * @return fNumber
     */
    public static function countAllLogins() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(logins)
                        FROM "prefix_players"
        ');

        try {
            return new fNumber($res->fetchScalar());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }

    /**
     * Gets the total distance of the specified type.<br>
     * To get the real total set $type to 'total'.
     *
     * @param $type
     *
     * @return fNumber
     */
    public static function getDistanceOfType($type) {
        try {
            if($type == 'total') {
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(foot) + SUM(minecart) + SUM(pig)
                        FROM "prefix_distance_players"
                ');
            }
            else {
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $type . ')
                        FROM "prefix_distance_players"
                ');
            }

            return new fNumber($res->fetchScalar());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        } catch(fSQLException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }

    /**
     * Returns the url friendly name
     *
     * @return string
     */
    public function getUrlName() {
        return fURL::makeFriendly($this->getName());
    }
}
