<?php
class ServerStatistic {

    private $db;

    private $values;

    function __construct() {
        $this->db = fORMDatabase::retrieve();
        $this->calcValues();
    }

    private function calcValues() {
        $res = $this->db->translatedQuery('
                        SELECT * FROM "prefix_server_statistics"
        ');

        foreach($res as $row)
            $this->values[$row['key']] = $row['value'];
    }

    function getValue($key) {
        if(isset($this->values[$key]))
            return $this->values[$key];
        else
            return '';
    }

    function getStartup() {
        $time = new fTimestamp($this->values['last_startup']);

        return $time->format('H:i:s - d.m.Y');
    }

    function getShutdown() {
        $time = new fTimestamp($this->values['last_shutdown']);

        return $time->format('H:i:s - d.m.Y');
    }

    function getCurrentUptime() {
        if($this->values['current_uptime'] == 0)
            return '00:00:00';

        $time = new fTimestamp($this->values['current_uptime']);

        return $time->format('d H:i:s');
    }

    function getTotalUptime() {
        if($this->values['total_uptime'] == 0)
            return '00:00:00';

        $time = new fTimestamp($this->values['total_uptime']);

        return $time->format('d H:i:s');
    }

}
