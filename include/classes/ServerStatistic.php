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
            self::$db = Util::getDatabase();

            $res = self::$db->translatedQuery('
                        SELECT * FROM "prefix_server_statistics"
            ');

            $res->tossIfNoRows();

            foreach($res as $row)
                self::$values[$row['key']] = $row['value'];
        } catch (fNoRowsException $e) {
            fCore::debug($e);
        } catch (fException $e) {
            fCore::debug($e);
        }

        fCore::debug(array('server statistics: ', self::$values));
    }

    /**
     * Returns all server statistics rows.
     *
     * @return array
     */
    public static function getValues() {
        self::calcValues();

        return self::$values;
    }

    /**
     * Returns the given value. If empty it will return 0.
     *
     * @param $key
     *
     * @return string|int
     */
    public static function getValue($key) {
        self::calcValues();

        if(isset(self::$values[$key]))
            return self::$values[$key];

        fCore::debug('not set: '. $key);

        return 0;
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
     * Returns the number of maximal online players.
     *
     * @return int
     */
    public static function getMaxPlayersOnline() {
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

    /**
     * Calculates the uptime percentage base up on the total uptime divided by the time now minus the first startup
     *
     * @return float
     */
    public static function getUptimePerc() {
        $perc = self::getValue('total_uptime') / (time() - self::getValue('first_startup')) * 100;

        return floor($perc);
    }

    /**
     * Returns the real time of the server.
     *
     * @return string
     */
    public static function getRealServerTime() {
        // taken from: http://forums.bukkit.org/threads/how-can-i-convert-minecraft-long-time-to-real-hours-and-minutes.122912/#post-1503545
        $time = self::getValue('server_time');
        $h = floor((($time / 1000) + 8) % 24); // 8 hours offset
        $m = floor(($time % 1000) / 1000 * 60);

        return sprintf('%02d:%02d', $h, $m);
    }

}
