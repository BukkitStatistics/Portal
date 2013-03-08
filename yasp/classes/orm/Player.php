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

        return 0;
    }


    /**
     * Counts all PVP+EVP kills
     *
     * @return fNumber
     */
    public static function countAllKills() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                      SELECT
                      (
                        SELECT SUM(times)
                        FROM "prefix_total_pvp_kills"
                      ) +
                      (
                        SELECT SUM(player_killed)
                        FROM "prefix_total_pve_kills"
                      )
        ');

        try {
            return new fNumber($res->fetchScalar());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        }

        return 0;
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

        return 0;
    }

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
    }

    public function getUrlName() {
        return fURL::makeFriendly($this->getName());
    }
}
