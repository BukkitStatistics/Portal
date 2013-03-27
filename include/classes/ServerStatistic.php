<?php
/**
 * This class is for the general statistics of the server.<br>
 * The values can be found in the "server_statistics" table.
 */
class ServerStatistic {

    /**
     * @var fDatabase
     */
    private static $db;

    /**
     * @var array
     */
    private static $values;

    /**
     * Fills values with database values.
     */
    private static function calcValues() {
        if(!is_null(self::$values))
            return;

        try {
            self::$db = fORMDatabase::retrieve();

            $res = self::$db->translatedQuery('
                        SELECT * FROM "prefix_server_statistics"
            ');

            $res->tossIfNoRows();

            foreach($res as $row)
                self::$values[$row['key']] = $row['value'];
        } catch (fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch (fException $e) {
        }
    }

    /**
     * Returns the given value. If empty it will return an empty string.
     *
     * @param $key
     *
     * @return string
     */
    public static function getValue($key) {
        self::calcValues();

        if(isset(self::$values[$key]))
            return self::$values[$key];
        else
            return '';
    }

    /**
     * Returns the formatted startup time
     *
     * @return fTimestamp
     */
    public static function getStartup() {
        return new fTimestamp(self::getValue('last_startup'));
    }

    /**
     * Returns the formatted shutdown time
     *
     * @return fTimestamp
     */
    public static function getShutdown() {
        return new fTimestamp(self::getValue('last_shutdown'));
    }

    /**
     * Returns the formatted current up time.
     *
     * @return string
     */
    public static function getCurrentUptime() {
        return Util::formatSeconds(new fTimestamp(self::getValue('current_uptime')));
    }

    /**
     * Returns the formatted total up time.
     *
     * @return string
     */
    public static function getTotalUptime() {
        return Util::formatSeconds(new fTimestamp(self::getValue('total_uptime')));
    }

    /**
     * Returns all online players.
     *
     * @return fNumber
     */
    public static function getPlayersOnline() {
        return new fNumber(fRecordSet::tally('Player', array('online=' => true)));
    }

    /**
     * Returns the number of maximal online players.<br>
     * If $get_time is true it will also return the formatted time.
     *
     * @param bool $get_time
     *
     * @return array|int|string
     */
    public static function getMaxPlayersOnline($get_time = false) {
        if(self::getValue('max_players_online') == 0)
            return 0;

        if($get_time) {
            return array(
                self::getValue('max_players_online'),
                new fTimestamp(self::getValue('max_players_online_time'))
            );
        }
        else
            return self::getValue('max_players_online');
    }


    /**
     * Returns true if the server is online.
     *
     * @return bool
     */
    public static function getStatus() {
        if(self::getValue('current_uptime') != 0 || self::getValue('last_startup') > self::getValue('last_shutdown'))
            return true;

        return false;
    }

    public static function getUptimePerc() {
        $perc = self::getValue('total_uptime') / (time() - self::getValue('first_startup')) * 100;

        return round($perc, 0);
    }

}
