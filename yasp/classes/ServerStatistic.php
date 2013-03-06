<?php
/**
 *
 */
class ServerStatistic {

    /**
     * @var fDatabase
     */
    private $db;

    /**
     * @var
     */
    private $values;

    /**
     *
     */
    function __construct() {
        $this->db = fORMDatabase::retrieve();
        $this->calcValues();
    }

    /**
     *
     */
    private function calcValues() {
        $res = $this->db->translatedQuery('
                        SELECT * FROM "prefix_server_statistics"
        ');

        foreach($res as $row)
            $this->values[$row['key']] = $row['value'];
    }

    /**
     * @param $key
     *
     * @return string
     */function getValue($key) {
        if(isset($this->values[$key]))
            return $this->values[$key];
        else
            return '';
}

    /**
     * @return string
     */function getStartup() {
        $time = new fTimestamp($this->getValue('last_startup'));

        return $time->format('H:i:s - d.m.Y');
}

    /**
     * @return string
     */function getShutdown() {
        $time = new fTimestamp($this->getValue('last_shutdown'));

        return $time->format('H:i:s - d.m.Y');
}

    /**
     * @return string
     */function getCurrentUptime() {
        if($this->getValue('current_uptime') == 0)
            return '00:00:00';

        $time = new fTimestamp($this->getValue('current_uptime'));

        return $time->format('d H:i:s');
}

    /**
     * @return string
     */function getTotalUptime() {
        if($this->getValue('total_uptime') == 0)
            return '00:00:00';

        $time = new fTimestamp($this->getValue('total_uptime'));

        return $time->format('d H:i:s');
}

    /**
     * @param bool $get_time
     * @return array|int|string
     */function getMaxPlayersOnline($get_time = false) {
        if($this->getValue('max_players_online') == 0)
            return 0;

        if($get_time) {
            $time = new fTimestamp($this->getValue('max_players_online_time'));

            return array($this->getValue('max_players_online'), $time->format('H:i - d.m.Y'));
        }
        else
            return $this->getValue('max_players_online');
    }

}
