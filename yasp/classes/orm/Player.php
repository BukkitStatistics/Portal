<?php
class Player extends fActiveRecord {

    public static  function countAllDeaths() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(times)
                        FROM "prefix_total_death_players"
        ');

        return $res->fetchScalar();
    }

    public static function countAllKills() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(times)
                        FROM "prefix_total_pvp_kills"
        ');

        return $res->fetchScalar();
    }

    public static function countAllLogins() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(logins)
                        FROM "prefix_players"
        ');

        return $res->fetchScalar();
    }
}
