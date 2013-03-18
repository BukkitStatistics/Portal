<?php
/**
 * This class is for the general statistics of the server.<br>
 * The values can be found in the "server_statistics" table.
 */
class ServerStatistic {

    /**
     * @var fDatabase
     */
    private $db;

    /**
     * @var array
     */
    private $values;

    /**
     * Get the database and fill $values.
     */
    function __construct() {
        $this->db = fORMDatabase::retrieve();
        $this->calcValues();
    }

    /**
     * Fills values with database values.
     */
    private function calcValues() {
        $res = $this->db->translatedQuery('
                        SELECT * FROM "prefix_server_statistics"
        ');

        $res->tossIfNoRows();

        foreach($res as $row)
            $this->values[$row['key']] = $row['value'];
    }

    /**
     * Returns the given value. If empty it will return an empty string.
     *
     * @param $key
     *
     * @return string
     */
    function getValue($key) {
        if(isset($this->values[$key]))
            return $this->values[$key];
        else
            return '';
}

    /**
     * Returns the formatted startup time
     *
     * @return fTimestamp
     */
    function getStartup() {
        return new fTimestamp($this->getValue('last_startup'));
}

    /**
     * Returns the formatted shutdown time
     *
     * @return fTimestamp
     */
    function getShutdown() {
        return new fTimestamp($this->getValue('last_shutdown'));
}

    /**
     * Returns the formatted current up time.
     *
     * @return string
     */
    function getCurrentUptime() {
        return Util::formatSeconds(new fTimestamp($this->getValue('current_uptime')));
    }

    /**
     * Returns the formatted total up time.
     *
     * @return string
     */
    function getTotalUptime() {
        return Util::formatSeconds(new fTimestamp($this->getValue('total_uptime')));
    }

    /**
     * Returns all online players.
     *
     * @return fNumber
     */
    function getPlayersOnline() {
        if($this->getValue('players_online') == 0)
            return new fNumber(0);

        return new fNumber($this->getValue('players_online'));
    }

    /**
     * Returns the number of maximal online players.<br>
     * If $get_time is true it will also return the formatted time.
     *
     * @param bool $get_time
     * @return array|int|string
     */
    function getMaxPlayersOnline($get_time = false) {
        if($this->getValue('max_players_online') == 0)
            return 0;

        if($get_time) {
            return array($this->getValue('max_players_online'),
                         new fTimestamp($this->getValue('max_players_online_time')));
        }
        else
            return $this->getValue('max_players_online');
    }

}
