<?php

class QueryUtils {

    const CLOCK_12 = 'M jS Y\, h:i:s a';
    const CLOCK_24 = 'M jS Y\, H:i:s';
    
    static function get2DArrayFromQuery($queryString) {
	$returnArray = array();
	$returnQuery = mysql_query($queryString);
	if(@mysql_num_rows($returnQuery) == 0) return false;
	$i = 0;
	while($row = mysql_fetch_assoc($returnQuery)) {
	    //iterate thru each row
	    foreach($row as $key => $value) {
		$returnArray[$i][$key] = $value;
	    }
	    ++$i;
	}
	return $returnArray;
    }

    public static function getResourceIdByName($resourceName) {
	$row = mysql_fetch_assoc(mysql_query("SELECT resource_id FROM resource_desc WHERE description = '{$resourceName}'"));
	return $row['resource_id'];
    }

    public static function getResourceNameById($resourceId) {
	$row = mysql_fetch_assoc(mysql_query("SELECT description FROM resource_desc WHERE resource_id = '{$resourceId}'"));
	return $row['description'];
    }

    public static function getResourceTable() {
	return QueryUtils::get2DArrayFromQuery("SELECT * FROM resource_desc ORDER BY description ASC");
    }

    public static function getItemList() {

        $order = self::getOrderType();

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'name':
                default:
                    $by = 'name';
                    break;
                case 'picked':
                    $by = 'picked';
                    break;
                case 'dropped':
                    $by = 'dropped';
                    break;
            }
        }
        else
            $by = 'name';

	return mysql_query('SELECT r.description name, 
		    						SUM(p.num_pickedup) picked, 
		    						SUM(p.num_dropped) dropped FROM pickup_drop p 
                                LEFT JOIN resource_desc r ON p.item = r.resource_id
                                GROUP BY p.item
                                ORDER BY ' . $by . ' ' . $order);
    }

    public static function getBlockList() {

        $order = self::getOrderType();

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'name':
                default:
                    $by = 'name';
                    break;
                case 'placed':
                    $by = 'placed';
                    break;
                case 'destroyed':
                    $by = 'destroyed';
                    break;
            }
        }
        else
            $by = 'name';

	    return mysql_query('SELECT r.description name,
		    						SUM(b.num_placed) placed, 
		    						SUM(b.num_destroyed) destroyed FROM blocks b 
                                LEFT JOIN resource_desc r ON b.block_id = r.resource_id
                                GROUP BY b.block_id
                                ORDER BY ' . $by . ' ' . $order);
    }

    public static function getKillTypeIdByName($killTypeName) {
	$row = mysql_fetch_assoc(mysql_query("SELECT id FROM kill_types WHERE description = '{$killTypeName}'"));
	return $row['id'];
    }

    public static function getKillTypeNameById($killTypeId) {
	$row = mysql_fetch_assoc(mysql_query("SELECT description FROM kill_types WHERE id = '{$killTypeId}'"));
	return $row['description'];
    }

    public static function getKillTypeTable() {
	return QueryUtils::get2DArrayFromQuery("SELECT * FROM kill_types ORDER BY id ASC");
    }

    public static function getCreatureIdByName($creatureName) {
	$row = mysql_fetch_assoc(mysql_query("SELECT id FROM creatures WHERE creature_name = '{$creatureName}'"));
	return $row['id'];
    }

    public static function getCreatureNameById($creatureId) {
	$row = mysql_fetch_assoc(mysql_query("SELECT creature_name FROM creatures WHERE id = '{$creatureId}'"));
	return $row['creature_name'];
    }

    public static function getCreatureTable() {
	return QueryUtils::get2DArrayFromQuery("SELECT * FROM creatures ORDER BY id ASC");
    }

    public static function getProjectileIdByName($projectileName) {
	$row = mysql_fetch_assoc(mysql_query("SEELCT id FROM projectiles WHERE projectile_name = '{$projectileName}'"));
	return $row['id'];
    }

    public static function getProjectileNameById($projectileId) {
	$row = mysql_fetch_assoc(mysql_query("SELECT projectile_name FROM projectiles WHERE id = '{$projectileId}'"));
	return $row['projectile_name'];
    }

    public static function getProjectilesTable() {
	return QueryUtils::get2DArrayFromQuery("SELECT * FROM projectiles ORDER BY id ASC");
    }

    public static function formatDate($ts) {	
	if(CLOCK24) return date(self::CLOCK_24, $ts);
	else return date(self::CLOCK_12, $ts);
    }

    public static function formatSecs($ns) {
	$time = "";

	$years = intval((intval($ns) / (86400 * 365)));

	$days = intval((intval($ns) / 86400) % 365);

	$hours = intval((intval($ns) / 3600) % 24);

	$minutes = intval(($ns / 60) % 60);

	$seconds = intval($ns % 60);

	if($years > 0) {
	    $time .= $years . ' ' . STRING_TIME_YEARS_ABV . ' ';
	}

	if($days > 0) {
	    $time .= $days . ' ' . STRING_TIME_DAYS_ABV . ' ';
	}

	if($hours > 0) {
	    $time .= $hours . ' ' . STRING_TIME_HOURS_ABV . ' ';
	}
	if($minutes > 0) {
	    $time .= $minutes . ' ' . STRING_TIME_MINUTES_ABV . ' ';
	}
	if($seconds > 0) {
	    $time .= $seconds . ' ' . STRING_TIME_SECONDS_ABV . ' ';
	}

	return $time;
    }

    public static function formatDistance($dis) {
	if($dis < 1000) {
	    return $dis . ' ' . STRING_DISTANCE_METERS;
	}

	if(USE_MEGAMETERS) {
	    if($dis < 1000000) {
		return round(($dis / 1000), 2) . ' ' . STRING_DISTANCE_KILOMETERS;
	    }
	}
	else {
	    return round(($dis / 1000), 2) . ' ' . STRING_DISTANCE_KILOMETERS;
	}

	return round(($dis / 1000000), 2) . ' ' . STRING_DISTANCE_MEGAMETERS;
    }

    public static function getOrderLink($by, $name) {
        if(isset($_GET['order']) && strtolower($_GET['order']) == 'desc')
            $order = 'asc';
        else
            $order = 'desc';

        $querystring = $_SERVER['QUERY_STRING'];
        $query_ar = explode('&', $_SERVER['QUERY_STRING']);
        $active = false;
        if(is_array($query_ar) && count($query_ar) > 2) {
            parse_str($_SERVER['QUERY_STRING'], $query_parse);
            $order_pos = array_search('order', array_keys($query_parse));
            $by_pos = array_search('by', array_keys($query_parse));
            if(isset($query_parse['by']) && $query_parse['by'] == $by)
                $active = true;
            unset($query_ar[$by_pos]);
            unset($query_ar[$order_pos]);
            $querystring = implode('&', $query_ar);
        }

        if($active) {
            if($order == 'desc')
                $arrow = '<img src="images/sort_down.png" alt="down" />';
            else
                $arrow = '<img src="images/sort_up.png" alt="up" />';
        }
        else
            $arrow = '';

        return '<a href="?' . $querystring . '&order=' . $order . '&by=' . $by . '">' . $name . ' ' . $arrow . '</a>';
    }

    public static function getOrderType($none=false) {
        if(!isset($_GET['order']) && $none)
            return '';
        elseif(isset($_GET['order']) && strtolower($_GET['order']) == 'desc')
            $order = 'DESC';
        else
            $order = 'ASC';


        return $order;
    }

}

?>