<?php
/* I beg you, please leave this area, touching anything here will just lead to you complaining on the forums */
/* unless you know what you're doing, then, by all means, be my guest, touch away. ~ ChaseHQ */

require_once('query_utils.php');

class PLAYER {
    private $_playerUUID;
    private $_playerRow;

    function __construct($playerUUID) {
        $this->_playerUUID = $playerUUID;
        $this->popCheck();
    }

    private function popCheck() {
        if(!isset($this->_playerRow))
            $this->_playerRow = mysql_fetch_assoc(mysql_query("SELECT * FROM players WHERE uuid = '{$this->_playerUUID}'"));
    }

    public function getName() {
        return $this->_playerRow['player_name'];
    }

    public function getUUID() {
        return $this->_playerUUID;
    }

    public function isOnline() {
        if($this->_playerRow['online'] == 'Y')
            return true;
        else return false;
    }

    public function getFirstLogin() {
        return $this->_playerRow['firstever_login'];
    }

    public function getLastLogin() {
        return $this->_playerRow['last_login'];
    }

    public function getNumberOfLogins() {
        return $this->_playerRow['num_logins'];
    }

    public function getCurrentLoginTime() {
        return $this->_playerRow['this_login'];
    }

    public function getNumberOfSecondsLoggedOn() {
        return $this->_playerRow['num_secs_loggedon'];
    }

    public function getDistanceTraveledTotal() {
        return $this->_playerRow['distance_traveled'];
    }

    public function getDistanceTraveledByMinecart() {
        return $this->_playerRow['distance_traveled_in_minecart'];
    }

    public function getDistanceTraveledByBoat() {
        return $this->_playerRow['distance_traveled_in_boat'];
    }

    public function getDistanceTraveledByPig() {
        return $this->_playerRow['distance_traveled_on_pig'];
    }

    public function getDistanceTraveledByFoot() {
        return $this->getDistanceTraveledTotal() - (
            $this->getDistanceTraveledByMinecart() + $this->getDistanceTraveledByBoat() +
            $this->getDistanceTraveledByPig());
    }

    public function getBlocksDestroyedOfType($id) {
        $row = mysql_fetch_assoc(mysql_query("SELECT num_destroyed FROM blocks WHERE uuid = '{$this->_playerUUID}' AND block_id = '{$id}'"));
        return $row['num_destroyed'];
    }

    public function getBlocksPlacedOfType($id) {
        $row = mysql_fetch_assoc(mysql_query("SELECT num_placed FROM blocks WHERE uuid = '{$this->_playerUUID}' AND block_id = '{$id}'"));
        return $row['num_placed'];
    }

    public function getBlocksDestroyedTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_destroyed) AS destroyedTotal FROM blocks WHERE uuid = '{$this->_playerUUID}'"));
        return $row['destroyedTotal'];
    }

    public function getBlocksPlacedTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_placed) AS placedTotal FROM blocks WHERE uuid = '{$this->_playerUUID}'"));
        return $row['placedTotal'];
    }

    public function getPlayerBlockTable() {
        return QueryUtils::get2DArrayFromQuery("SELECT block_id, num_destroyed, num_placed FROM blocks WHERE uuid = '{$this->_playerUUID}'");
    }

    public function getBlocksMostDestroyed() {
        $row = mysql_fetch_assoc(mysql_query('SELECT block_id,
                                                SUM(num_destroyed) AS sum
                                                FROM blocks
                                                WHERE uuid = "' . $this->_playerUUID . '"
                                                GROUP BY block_id
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row;
    }

    public function getBlocksMostPlaced() {

        $row = mysql_fetch_assoc(mysql_query('SELECT block_id,
                                                SUM(num_placed) AS sum
                                                FROM blocks
                                                WHERE uuid = "' . $this->_playerUUID . '"
                                                GROUP BY block_id
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row;
    }

    public function getPickedUpOfType($id) {
        $row = mysql_fetch_assoc(mysql_query("SELECT num_pickedup FROM pickup_drop WHERE uuid = '{$this->_playerUUID}' AND item = '{$id}'"));
        return $row['num_pickedup'];
    }

    public function getDroppedOfType($id) {
        $row = mysql_fetch_assoc(mysql_query("SELECT num_dropped FROM pickup_drop WHERE uuid = '{$this->_playerUUID}' AND item = '{$id}'"));
        return $row['num_dropped'];
    }

    public function getPickedUpTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_pickedup) AS totalPickedup FROM pickup_drop WHERE uuid = '{$this->_playerUUID}'"));
        return $row['totalPickedup'];
    }

    public function getDroppedTotal() {
        $row = mysql_fetch_assoc(mysql_query("SELECT SUM(num_dropped) AS totalDropped FROM pickup_drop WHERE uuid = '{$this->_playerUUID}'"));
        return $row['totalDropped'];
    }

    public function getMostPickedUp() {
        $row = mysql_fetch_assoc(mysql_query('SELECT item,
                                                SUM(num_pickedup) AS sum
                                                FROM pickup_drop
                                                WHERE uuid = "' . $this->_playerUUID . '"
                                                GROUP BY item
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row['item'];
    }

    public function getMostDropped() {
        $row = mysql_fetch_assoc(mysql_query('SELECT item,
                                                SUM(num_dropped) AS sum
                                                FROM pickup_drop
                                                WHERE uuid = "' . $this->_playerUUID . '"
                                                GROUP BY item
                                                ORDER BY sum DESC
                                                LIMIT 0,1'));
        return $row['item'];
    }

    public function getPlayerKillTable() {
        return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_by_uuid = '{$this->_playerUUID}'");
    }

    public function getMostDangerousWeapon() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_using` name, COUNT(`killed_using`) count
                                                FROM kills
                                                WHERE killed_using != -1
                                                AND killed_by_uuid = "' . $this->_playerUUID . '"
                                                GROUP BY `killed_using`
                                                ORDER BY count DESC
                                                LIMIT 0,1'));
        return $row;
    }

    public function getMostKilledPVP() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_uuid` name, COUNT(`killed_uuid`) count
                                                FROM kills
                                                WHERE `killed_uuid` IS NOT NULL
                                                    AND `killed_uuid` != " "
                                                    AND `killed_by_uuid` = "' . $this->_playerUUID . '"
                                                GROUP BY `killed_uuid`
                                                ORDER BY count DESC
                                                LIMIT 0,1'));
        return $row;
    }

    public function getMostKilledByPVP() {
        $row = mysql_fetch_assoc(mysql_query('SELECT `killed_by_uuid` name, COUNT(`killed_by_uuid`) count
                                                FROM kills
                                                WHERE `killed_uuid` = "' . $this->_playerUUID . '"
                                                    AND `killed_by_uuid` IS NOT NULL
                                                    AND `killed_by_uuid` != " "
                                                GROUP BY `killed_by_uuid`
                                                ORDER BY count DESC'));
        return $row;
    }

    public function getPlayerKillTablePVP($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed = '{$playerCreatureId}' AND killed_by_uuid = '{$this->_playerUUID}' ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed = '{$playerCreatureId}' AND killed_by_uuid = '{$this->_playerUUID}' ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerKillDeathTablePVP($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed = '{$playerCreatureId}' AND killed_by = '{$playerCreatureId}') AND  (killed_by_uuid = '{$this->_playerUUID}' OR killed_uuid = '{$this->_playerUUID}') ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed = '{$playerCreatureId}' AND killed_by = '{$playerCreatureId}') AND  (killed_by_uuid = '{$this->_playerUUID}' OR killed_uuid = '{$this->_playerUUID}') ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerDeathTablePVP($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_by = '{$playerCreatureId}' AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_by = '{$playerCreatureId}' AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerKillTablePVE($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        $noneCreatureId = QueryUtils::getCreatureIdByName("None");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed != '{$playerCreatureId}' AND killed != '{$noneCreatureId}') AND killed_by_uuid = '{$this->_playerUUID}' ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed != '{$playerCreatureId}' AND killed != '{$noneCreatureId}') AND killed_by_uuid = '{$this->_playerUUID}' ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerKillDeathTablePVE($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        $noneCreatureId = QueryUtils::getCreatureIdByName("None");
        $blockCreatureId = QueryUtils::getCreatureIdByName("Block");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE ((killed != '{$playerCreatureId}' AND killed != '{$noneCreatureId}') XOR (killed_by != '{$playerCreatureId}' AND killed_by != '{$noneCreatureId}' AND killed_by != '{$blockCreatureId}'))  AND (killed_by_uuid = '{$this->_playerUUID}' OR killed_uuid = '{$this->_playerUUID}' ) ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE ((killed != '{$playerCreatureId}' AND killed != '{$noneCreatureId}') XOR (killed_by != '{$playerCreatureId}' AND killed_by != '{$noneCreatureId}' AND killed_by != '{$blockCreatureId}'))  AND (killed_by_uuid = '{$this->_playerUUID}' OR killed_uuid = '{$this->_playerUUID}' ) ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerDeathTablePVE($limit = false, $limitStart = 0, $limitNumber = 0) {
        $playerCreatureId = QueryUtils::getCreatureIdByName("Player");
        $noneCreatureId = QueryUtils::getCreatureIdByName("None");
        $blockCreatureId = QueryUtils::getCreatureIdByName("Block");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed_by != '{$playerCreatureId}' AND killed_by != '{$noneCreatureId}' AND killed_by != '{$blockCreatureId}') AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed_by != '{$playerCreatureId}' AND killed_by != '{$noneCreatureId}' AND killed_by != '{$blockCreatureId}') AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerDeathTableOther($limit = false, $limitStart = 0, $limitNumber = 0) {
        $noneCreatureId = QueryUtils::getCreatureIdByName("None");
        $blockCreatureId = QueryUtils::getCreatureIdByName("Block");
        if(!$limit)
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed = '{$noneCreatureId}' OR killed = '{$blockCreatureId}') XOR (killed_by = '{$noneCreatureId}' OR killed_by = '{$blockCreatureId}') AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC");
        else
            return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE (killed = '{$noneCreatureId}' OR killed = '{$blockCreatureId}') XOR (killed_by = '{$noneCreatureId}' OR killed_by = '{$blockCreatureId}') AND killed_uuid = '{$this->_playerUUID}' ORDER BY id DESC LIMIT {$limitStart},{$limitNumber}");
    }

    public function getPlayerMostDangerousPVECreature() {
        $ignoreID = QueryUtils::getCreatureIdByName("Player");
        $noneID = QueryUtils::getCreatureIdByName("None");
        $blockID = QueryUtils::getCreatureIdByName("Block");

        $highest = 0;
        $idOfHighest = 0;

        foreach(QueryUtils::getCreatureTable() as $creatureRow) {

            if($creatureRow['id'] == $ignoreID)
                continue;
            if($creatureRow['id'] == $noneID)
                continue;
            if($creatureRow['id'] == $blockID)
                continue;

            $res = $this->getPlayerDeathTableCreature($creatureRow['id']);

            if($res)
                $test = count($res);
            else
                $test = 0;

            if($test > $highest) {
                $highest = $test;
                $idOfHighest = $creatureRow['id'];
            }
        }

        return $idOfHighest;
    }

    public function getPlayerMostKilledPVECreature() {
        $ignoreID = QueryUtils::getCreatureIdByName("Player");
        $noneID = QueryUtils::getCreatureIdByName("None");
        $highest = 0;
        $idOfHighest = 0;

        foreach(QueryUtils::getCreatureTable() as $creatureRow) {

            if($creatureRow['id'] == $ignoreID)
                continue;
            if($creatureRow['id'] == $noneID)
                continue;

            $res = $this->getPlayerKillTableCreature($creatureRow['id']);
            if($res)
                $test = count($res);
            else
                $test = 0;

            if($test > $highest) {
                $highest = $test;
                $idOfHighest = $creatureRow['id'];
            }
        }

        return $idOfHighest;
    }

    public function getPlayerDeathTable() {
        return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_uuid = '{$this->_playerUUID}'");
    }

    public function getPlayerKillTableCreature($creatureTypeId) {
        return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_by_uuid = '{$this->_playerUUID}' AND killed = '{$creatureTypeId}'");
    }

    public function getPlayerDeathTableCreature($creatureTypeId) {
        return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_uuid = '{$this->_playerUUID}' AND killed_by = '{$creatureTypeId}'");
    }

    public function getPlayerDeathTableType($killTypeId) {
        return QueryUtils::get2DArrayFromQuery("SELECT * FROM kills WHERE killed_uuid = '{$this->_playerUUID}' AND kill_type = '{$killTypeId}'");
    }
}

?>