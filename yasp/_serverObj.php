<?php
/* I beg you, please leave this area, touching anything here will just lead to you complaining on the forums */
/* unless you know what you're doing, then, by all means, be my guest, touch away. ~ ChaseHQ */

require_once('_playerObj.php');
require_once('query_utils.php');

class SERVER {
    private $_serverRow;
    private $_playerRow;
    private $_blockRow;

    function __construct() {
        $this->_serverRow = mysql_fetch_assoc(mysql_query('SELECT * FROM server'));
        $this->_playerRow = mysql_fetch_assoc(mysql_query('SELECT SUM(num_logins) AS numLogin,
	        													SUM(num_secs_loggedon) AS secLogin, 
	        													SUM(distance_traveled) AS distTravel, 
	        													SUM(distance_traveled_in_minecart) AS distTravelMc, 
	        													SUM(distance_traveled_in_boat) AS distTravelBoat, 
	        													SUM(distance_traveled_on_pig) AS distTravelPig 
	        													FROM players'));
        $this->_blockRow = mysql_fetch_assoc(mysql_query('SELECT SUM(num_destroyed) AS destroyedTotal,
	        												 	SUM(num_placed) AS placedTotal 
	        													FROM blocks'));
    }

    public function getPlayer($uuid) {
        return new PLAYER($uuid);
    }
    
    public function getPlayerByName($playerName) {
    	$query = mysql_query('SELECT uuid FROM players ORDER BY player_name ASC');
        $ar = array();
        while($row = mysql_fetch_assoc($query)) {
            $ar[] = $this->getPlayer($row['uuid']);
        }
        
    	foreach($ar as $plObj) {
    		if($plObj->getName() == $playerName) return $plObj;
    	}
    	return null;
    }

    public function getAllPlayers() {
        $search = $this->getSearchQuery();

        return mysql_num_rows(mysql_query('SELECT uuid FROM players ' . $search));
    }
    
    public function getAllPlayersForRealNow() {
    	return mysql_query('SELECT uuid FROM players ORDER BY player_name ASC');
    }

    public function getAllPlayersOnlineCount() {
        return mysql_num_rows(mysql_query('SELECT uuid FROM players WHERE online = "Y"'));
    }

    public function getAllPlayerNames() {
        $query = mysql_query('SELECT uuid FROM players ORDER BY player_name ASC');
        $ar = array();
        while($row = mysql_fetch_assoc($query)) {
            $ar[] = $this->getPlayer($row['uuid'])->getName();
        }

        return $ar;

    }

    public function getAllPlayersOnline() {
        $query = mysql_query('SELECT uuid FROM players WHERE online = "Y" ORDER BY player_name ASC');
        $ar = array();
        while($row = mysql_fetch_assoc($query)) {
            $ar[] = $this->getPlayer($row['uuid']);
        }

        return $ar;

    }

    public function getPlayers($limit) {

        $order = QueryUtils::getOrderType();

        if(isset($_GET['by'])) {
            switch (strtolower($_GET['by'])) {
                case 'name':
                default:
                    $by = 'player_name';
                    break;
                case 'logon':
                    $by = 'last_login';
                    break;
                case 'register':
                    $by = 'firstever_login';
                    break;
            }
        }
        else
            $by = 'player_name';

        $search = $this->getSearchQuery();
        return mysql_query('SELECT uuid
                            FROM players
                            ' . $search . '
                            ORDER by ' . $by . ' ' . $order . '
                            ' . $limit);
    }

    public function getUptimeInSeconds() {
        $sut = $this->getStartupTime();
        $sdt = $this->getLastShutdownTime();
        if($sdt > $sut)
            return 'Offline';
        $now = time();
        return QueryUtils::formatSecs($now - $sut);
    }
    
    public function getServerStatus() {
        $sut = $this->getStartupTime();
        $sdt = $this->getLastShutdownTime();
        if($sdt > $sut) return 'Offline';
        return "Online";
    }

    public function getStartupTime() {
        return $this->_serverRow['startup_time'];
    }

    public function getLastShutdownTime() {
        return $this->_serverRow['shutdown_time'];
    }

    public function getNumberCurrentOnline() {
        return mysql_num_rows(mysql_query('SELECT uuid FROM players WHERE online = "Y"'));
    }

    public function getNumberOfLoginsTotal() {
        return $this->_playerRow['numLogin'];
    }

    public function getMaxPlayersEverOnline() {
        return $this->_serverRow['max_players_ever_online'];
    }

    public function getMaxPlayersEverOnlineTimeWhenOccured() {
        return $this->_serverRow['max_players_ever_online_time'];
    }

    public function getNumberOfSecondsLoggedOnTotal() {
        return $this->_playerRow['secLogin'];
    }

    public function getDistanceTraveledTotal() {
        return $this->_playerRow['distTravel'];
    }

    public function getDistanceTraveledByMinecartTotal() {
        return $this->_playerRow['distTravelMc'];
    }

    public function getDistanceTraveledByBoatTotal() {
        return $this->_playerRow['distTravelBoat'];
    }

    public function getDistanceTraveledByPigTotal() {
        return $this->_playerRow['distTravelPig'];
    }

    public function getDistanceTraveledByFootTotal() {
        return $this->getDistanceTraveledTotal() -
               ($this->getDistanceTraveledByMinecartTotal() + $this->getDistanceTraveledByBoatTotal() +
                $this->getDistanceTraveledByPigTotal());
    }

    public function getBlocksDestroyedOfTypeTotal($id) {
        $row = mysql_fetch_assoc(mysql_query(
                                     'SELECT SUM(num_destroyed) AS num_destroyed
                                     FROM blocks WHERE block_id = "' . $id .
                                     '"'));
        return $row['num_destroyed'];
    }

    public function getBlocksPlacedOfTypeTotal($id) {
        $row = mysql_fetch_assoc(mysql_query(
                                     'SELECT SUM(num_placed) AS num_placed
                                     FROM blocks WHERE block_id = ' . $id));
        return $row['num_placed'];
    }

    public function getBlocksDestroyedTotal() {
        return $this->_blockRow['destroyedTotal'];
    }

    public function getBlocksPlacedTotal() {
        return $this->_blockRow['placedTotal'];
    }

    public function getBlocksMostDestroyed() {
        $row = mysql_fetch_assoc(mysql_query('SELECT block_id,
                                                    SUM(num_destroyed) AS sum 
                                                    FROM blocks GROUP BY block_id 
                                                    ORDER BY sum DESC 
                                                    LIMIT 0,1'));
        return $row['block_id'];
    }

    public function getBlocksMostPlaced() {
        $row = mysql_fetch_assoc(mysql_query('SELECT block_id,
                                                    SUM(num_placed) AS sum 
                                                    FROM blocks GROUP BY block_id 
                                                    ORDER BY sum DESC 
                                                    LIMIT 0,1'));
        return $row['block_id'];
    }

    public function getPickedUpOfTypeTotal($id) {
        $row = mysql_fetch_assoc(mysql_query(
                                     'SELECT SUM(num_pickedup) AS num_pickedup
                                     FROM pickup_drop WHERE item = "' . $id .
                                     '"'));
        return $row['num_pickedup'];
    }

    public function getDroppedOfTypeTotal($id) {
        $row = mysql_fetch_assoc(mysql_query(
                                     'SELECT SUM(num_dropped) AS num_dropped
                                     FROM pickup_drop WHERE item = "' . $id .
                                     '"'));
        return $row['num_dropped'];
    }

    public function getPickedUpTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_pickedup) AS totalPickedup
                                            FROM pickup_drop"));
        return $row['totalPickedup'];
    }

    public function getDroppedTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_dropped) AS totalDropped
                                            FROM pickup_drop"));
        return $row['totalDropped'];
    }

    public function getMostPickedUp() {
        $row = mysql_fetch_assoc(mysql_query('SELECT item,
                                                SUM(num_pickedup) AS sum
                                                FROM pickup_drop GROUP BY item
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row['item'];
    }

    public function getMostDropped() {
        $row = mysql_fetch_assoc(mysql_query('SELECT item,
                                                SUM(num_dropped) AS sum
                                                FROM pickup_drop GROUP BY item
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row['item'];
    }

    public function getTotalKills() {
        $row = mysql_fetch_assoc(mysql_query('SELECT COUNT(id) total FROM kills'));
        return $row['total'];
    }
    
    public function getAllKills() {

        $order = QueryUtils::getOrderType(true);
        if($order == '') { $order = 'DESC'; }

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'time':
                default:
                    $by = 'time';
                    break;
                case 'killer':
                    $by = 'killer';
                    break;
                case 'victim':
                    $by = 'victim';
                    break;
                case 'weapon':
                    $by = 'weapon';
                    break;
            }
        }
        else
            $by = 'time';

        return mysql_query('SELECT r.description weapon,
		    						c.creature_name killer, 
		    						p.player_name killer_player, 
		    						p.uuid killerID,
		    						c2.creature_name killed, 
		    						p2.player_name killed_player, 
		    						p2.uuid killedID,
		    						k.time time 
		    					FROM kills k
                                INNER JOIN resource_desc r ON k.killed_using = r.resource_id
                                LEFT JOIN creatures c ON k.killed_by = c.id
                                LEFT JOIN creatures c2 ON k.killed = c2.id
                                LEFT JOIN players p ON k.killed_by_uuid = p.uuid
                                LEFT JOIN players p2 ON k.killed_uuid = p2.uuid
                                WHERE k.killed_by != 0
                                	AND k.killed_by != 18
                                	AND k.killed != 0
                                	AND k.killed != 18
                                ORDER BY ' . $by . ' ' . $order . '');
    }
    
    public function getKills($limit) {

        $order = QueryUtils::getOrderType(true);
        if($order == '') { $order = 'DESC'; }

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'time':
                default:
                    $by = 'time';
                    break;
                case 'killer':
                    $by = 'killer';
                    break;
                case 'victim':
                    $by = 'victim';
                    break;
                case 'weapon':
                    $by = 'weapon';
                    break;
            }
        }
        else
            $by = 'time';

        return mysql_query('SELECT r.description weapon,
		    						c.creature_name killer, 
		    						p.player_name killer_player, 
		    						p.uuid killerID,
		    						c2.creature_name killed, 
		    						p2.player_name killed_player, 
		    						p2.uuid killedID,
		    						k.time time 
		    					FROM kills k
                                INNER JOIN resource_desc r ON k.killed_using = r.resource_id
                                LEFT JOIN creatures c ON k.killed_by = c.id
                                LEFT JOIN creatures c2 ON k.killed = c2.id
                                LEFT JOIN players p ON k.killed_by_uuid = p.uuid
                                LEFT JOIN players p2 ON k.killed_uuid = p2.uuid
                                WHERE k.killed_by != 0
                                	AND k.killed_by != 18
                                	AND k.killed != 0
                                	AND k.killed != 18
                                ORDER BY ' . $by . ' ' . $order . '
		    					' . $limit . '');
    }

    public function getTotalPVPKills() {
        $row = mysql_fetch_assoc(mysql_query('SELECT COUNT(id) total FROM kills
                                                WHERE killed = 999
                                                    AND killed_by = 999'));
        return $row['total'];
    }

    public function getPVPKills($limit) {

        $order = QueryUtils::getOrderType(true);
        if($order == '')
            $order = 'DESC';

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'time':
                default:
                    $by = 'time';
                    break;
                case 'killer':
                    $by = 'killer';
                    break;
                case 'victim':
                    $by = 'victim';
                    break;
                case 'weapon':
                    $by = 'weapon';
                    break;
            }
        }
        else
            $by = 'time';

        return mysql_query('SELECT p.player_name killer,
		    						p.uuid killerID,
		    						p2.player_name victim,
		    						p2.uuid killedID,
		    						k.time time, 
		    						r.description weapon 
		    					FROM kills k
                                INNER JOIN resource_desc r ON k.killed_using = r.resource_id
                                INNER JOIN players p ON k.killed_by_uuid = p.uuid
                                INNER JOIN players p2 ON k.killed_uuid = p2.uuid
                                WHERE k.killed = 999 
                                	AND k.killed_by = 999
                                ORDER BY ' . $by . ' ' . $order . '
		    					' . $limit . '');
    }

    public function getTotalPVEKills() {
        $row = mysql_fetch_assoc(mysql_query('SELECT COUNT(id) total FROM kills
                                                WHERE killed != 18
                                                    AND killed != 0
                                                    AND killed != 999
                                                    AND killed_by != 18
                                                    AND killed_by != 0'));
        return $row['total'];
    }

    public function getPVEKills($limit) {

        $order = QueryUtils::getOrderType(true);
        if($order == '')
            $order = 'DESC';

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'time':
                default:
                    $by = 'time';
                    break;
                case 'killer':
                    $by = 'killer_player';
                    break;
                case 'victim':
                    $by = 'killed_player';
                    break;
                case 'weapon':
                    $by = 'weapon';
                    break;
            }
        }
        else
            $by = 'time';

        return mysql_query('SELECT r.description weapon,
		    						c.creature_name killer, 
		    						p.player_name killer_player, 
		    						p.uuid killerID,
		    						c2.creature_name killed, 
		    						p2.player_name killed_player, 
		    						p2.uuid killedID,
		    						k.time time 
		    					FROM kills k
                                INNER JOIN resource_desc r ON k.killed_using = r.resource_id
                                LEFT JOIN creatures c ON k.killed_by = c.id
                                LEFT JOIN creatures c2 ON k.killed = c2.id
                                LEFT JOIN players p ON k.killed_by_uuid = p.uuid
                                LEFT JOIN players p2 ON k.killed_uuid = p2.uuid
                                WHERE k.killed_by != 0
                                	AND k.killed_by != 18
                                	AND k.killed != 0
                                	AND k.killed != 18
                                ORDER BY ' . $by . ' ' . $order . '
		    					' . $limit . '');
    }

    public function getTotalOtherKills() {
        $row = mysql_fetch_assoc(mysql_query('SELECT COUNT(id) total FROM kills
                                                WHERE killed_by = 0
                                                    OR killed_by = 18'));
        return $row['total'];
    }

    public function getOtherKills($limit) {

        $order = QueryUtils::getOrderType(true);
        if($order == '')
            $order = 'DESC';

        if(isset($_GET['by'])) {
            switch(strtolower($_GET['by'])) {
                case 'time':
                default:
                    $by = 'k.time';
                    break;
                case 'victim':
                    $by = 'killed';
                    break;
                case 'reason':
                    $by = 'type';
                    break;
            }
        }
        else
            $by = 'k.time';

        return mysql_query('SELECT p.player_name killed,
		    						t.description type, 
		    						k.time 
		    					FROM kills k
                                INNER JOIN kill_types t ON k.kill_type = t.id
                                INNER JOIN players p ON k.killed_uuid = p.uuid
                                WHERE killed_by = 0
                                	OR killed_by = 18
                                ORDER BY ' . $by . ' ' . $order . '
		    					' . $limit . '');
    }

    public function getMostKillerPVP() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_by_uuid` name, COUNT(`killed_by_uuid`) count
                                                FROM kills
                                                WHERE `killed_uuid` IS NOT NULL
                                                    AND `killed_uuid` != " "
                                                    AND `killed_by_uuid` IS NOT NULL
                                                    AND `killed_by_uuid` != " "
                                                GROUP BY `killed_by_uuid`
                                                ORDER BY count DESC'));
        return $row;
    }

    public function getMostKilledPVP() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_uuid` name, COUNT(`killed_uuid`) count
                                                FROM kills
                                                WHERE `killed_uuid` IS NOT NULL
                                                    AND `killed_uuid` != " "
                                                    AND `killed_by_uuid` IS NOT NULL
                                                    AND `killed_by_uuid` != " "
                                                GROUP BY `killed_uuid`
                                                ORDER BY count DESC'));
        return $row;
    }

    public function getMostDangerousWeapon() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_using` name, COUNT(`killed_using`) count
                                                FROM kills
                                                WHERE killed_using != -1
                                                GROUP BY `killed_using`
                                                ORDER BY count DESC'));
        return $row;
    }


    public function getMostDangerousPVECreature() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_by` name, COUNT(`killed_by`) count
                                                FROM kills
                                                WHERE killed_by != 999
                                                    AND killed_by != 0
                                                    AND killed_by != 18
                                                GROUP BY `killed_by`
                                                ORDER BY count DESC'));
        return $row;
    }

    public function getMostKilledPVECreature() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed` name, COUNT(`killed`) count
                                                FROM kills
                                                WHERE killed != 999
                                                    AND killed != 0
                                                    AND killed != 18
                                                GROUP BY `killed`
                                                ORDER BY count DESC'));
        return $row;
    }

    public function getTotalTypeKills($typeID) {
        $row = mysql_fetch_assoc(mysql_query('SELECT COUNT(id) count FROM kills
                                                WHERE kill_type = ' . $typeID));
        return $row['count'];
    }

    private function getSearchQuery() {
        if(isset($_GET['search']) &&  !empty($_GET['search'])) {
            $search_string = (string)$_GET['search'];
            return 'WHERE LOWER(player_name) LIKE "%' . $search_string . '%"';
        }

        return '';
    }

}

?>