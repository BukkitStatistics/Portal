<?php
/**
 * This class represents an single player in the players table.
 */
class Player extends fActiveRecord {

    /**
     * Returns the total playtime of all players.
     *
     * @return int
     */
    public static function countTotalPlaytime() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(playtime)
                        FROM "prefix_players"
        ');

        try {
            return Util::formatSeconds(new fTimestamp($res->fetchScalar()));
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        } catch(fValidationException $e) {
            fCore::debug($e->getMessage());
        }

        return Util::formatSeconds(new fTimestamp(0));
    }

    public static function getPlayerId($name) {
        $res = fORMDatabase::retrieve()->translatedQuery('
            SELECT player_id
            FROM "prefix_players"
            WHERE name = %s
            ', $name);

        try {
            return $res->fetchScalar();
        } catch (fNoRowsException $e) {
            return 0;
        }
    }

    /**
     * Counts all the kills of the specified type.
     *
     * @param string $type
     *
     * @return fNumber
     */
    public static function countAllKillsOfType($type = 'all') {
        if($type == 'pvp')
            $sql = '
                    SELECT SUM(times)
                    FROM "prefix_total_pvp_kills"
            ';
        elseif($type == 'evp')
            $sql = '
                    SELECT SUM(player_killed)
                    FROM "prefix_total_pve_kills"
            ';
        elseif($type == 'pve')
            $sql = '
                    SELECT SUM(creature_killed)
                    FROM "prefix_total_pve_kills"
            ';
        else
            $sql = '
                    SELECT
                      (
                        SELECT SUM(times)
                        FROM "prefix_total_pvp_kills"
                      ) +
                      (
                        SELECT SUM(player_killed)
                        FROM "prefix_total_pve_kills"
                      ) +
                      (
                        SELECT SUM(creature_killed)
                        FROM "prefix_total_pve_kills"
                      )
            ';

        $res = fORMDatabase::retrieve()->translatedQuery($sql);

        try {
            return new fNumber($res->fetchScalar());
        } catch(fException $e) {
            fCore::debug($e);
        }

        return new fNumber(0);
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
        } catch(fException $e) {
            fCore::debug($e);
        }

        return new fNumber(0);
    }

    /**
     * Gets the most dangerous player.<br>
     * The first array value is an fNumber which is the count. The second one is the player.
     *
     * @return array
     */
    public static function getMostDangerous() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pvp.times) AS total, pvp.player_id FROM "prefix_total_pvp_kills" pvp
                    GROUP BY pvp.player_id
                    ORDER BY SUM(pvp.times) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), new Player($row['player_id']));
        } catch(fException $e) {
            fCore::debug($e);
        }

        $p = new Player();
        return array(0, $p->setName('none'));
    }


    /**
     * Gets the most killed player.<br>
     * The first array value is an fNumber which is the count. The second one is the player.
     *
     * @return array
     */
    public static function getMostKilled() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pvp.times) AS total, pvp.victim_id FROM "prefix_total_pvp_kills" pvp
                    GROUP BY pvp.victim_id
                    ORDER BY SUM(pvp.times) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), new Player($row['victim_id']));
        } catch(fException $e) {
            fCore::debug($e);
        }

        $p = new Player();
        return array(0, $p->setName('none'));
    }

    /**
     * Stores calculated total blocks
     *
     * @var array
     */
    private $blocks = array();

    /**
     * Stores calculated total items
     *
     * @var array
     */
    private $items = array();

    /**
     * Stores calculated total pve kills
     *
     * @var array
     */
    private $pve = array();

    /**
     * Stores calculated total pvp kills
     *
     * @var array
     */
    private $pvp = array();

    /**
     * Counts all blocks
     */
    private function countBlocks() {
        $blocks = $this->buildTotalBlocks();

        $this->blocks['destroyed'] = new fNumber(0);
        $this->blocks['placed'] = new fNumber(0);
        foreach($blocks as $block) {
            $this->blocks['destroyed'] = $this->blocks['destroyed']->add($block->getDestroyed());
            $this->blocks['placed'] = $this->blocks['placed']->add($block->getPlaced());
        }
    }

    /**
     * Counts all items
     */
    private function countItems() {
        $items = $this->buildTotalItems();

        $this->items['picked'] = new fNumber(0);
        $this->items['dropped'] = new fNumber(0);
        foreach($items as $item) {
            $this->items['picked'] = $this->items['picked']->add($item->getPickedUp());
            $this->items['dropped'] = $this->items['dropped']->add($item->getDropped());
        }
    }

    /**
     * Counts all pve kills
     */
    private function countPve() {
        $pve = $this->buildTotalPveKills();

        $this->pve['kills'] = new fNumber(0);
        $this->pve['deaths'] = new fNumber(0);
        foreach($pve as $pve_kill) {
            $this->pve['kills'] = $this->pve['kills']->add($pve_kill->getCreatureKilled());
            $this->pve['deaths'] = $this->pve['deaths']->add($pve_kill->getPlayerKilled());
        }
    }

    /**
     * Counts all pvp kills
     */
    private function countPvp() {
        $pvp_killer = $this->buildTotalPvpKills('player_id');
        $pvp_victim = $this->buildTotalPvpKills('victim_id');

        $this->pvp['kills'] = new fNumber(0);
        foreach($pvp_killer as $kill)
            $this->pvp['kills'] = $this->pvp['kills']->add($kill->getTimes());

        $this->pvp['deaths'] = new fNumber(0);
        foreach($pvp_victim as $death)
            $this->pvp['deaths'] = $this->pvp['deaths']->add($death->getTimes());
    }

    private function getSkin() {
        $headers = get_headers('http://s3.amazonaws.com/MinecraftSkins/' . $this->getName() . '.png');
        if(isset($headers[7]) &&
           ($headers[7] == 'Content-Type: image/png' || $headers[7] == 'Content-Type: application/octet-stream')
        ) {
            $path = 'http://s3.amazonaws.com/MinecraftSkins/' . $this->getName() . '.png';
        }
        else {
            $path = __ROOT__ . 'media/img/misc/char.png';
        }

        return $path;
    }

    /**
     * Returns the url friendly name
     *
     * @return string
     */
    public function getUrlName() {
        return fURL::makeFriendly($this->getName());
    }

    /**
     * Returns the html code to the player head image.<br>
     * If no image was found it will return the default image.<br>
     * Use $tooltip to show an bootstrap tooltip over the image instead if an simple browser alt tag.
     *
     * @param int    $size
     * @param String $classes
     * @param bool   $tooltip
     *
     * @return mixed
     */
    public function getPlayerHead($size = 32, $classes = null, $tooltip = false) {
        $name = __ROOT__ . 'cache/skins/head-' . $size . '_' . $this->getUrlName() . '.png';

        if(!file_exists($name)) {
            $canvas = imagecreatetruecolor($size, $size);
            $image = imagecreatefromstring(file_get_contents($this->getSkin()));
            imagecopyresampled($canvas, $image, 0, 0, 8, 8, $size, $size, 8, 8);

            imagepng($canvas, $name);

            fCore::debug('new player head:' . $this->getName());
        }


        if(!is_null($classes))
            $class = 'class="' . $classes . '"';
        else
            $class = '';

        if($tooltip)
            $tooltip = 'rel="tooltip"';
        else
            $tooltip = '';

        return '<img ' . $class . ' src="' . fFilesystem::translateToWebPath($name) . '" alt="' . $this->getName() .
               '" title="' . $this->getName() . '" ' . $tooltip . '>';
    }

    /**
     * Returns an associative array containing placed and destroyed blocks
     *
     * @return array
     */
    public function getTotalBlocks() {
        if(empty($this->blocks))
            $this->countBlocks();

        return $this->blocks;
    }

    /**
     * Returns an associative array containing picked and dropped items
     *
     * @return array
     */
    public function getTotalItems() {
        if(empty($this->items))
            $this->countItems();

        return $this->items;
    }

    /**
     * Returns an associative array containing pve kills and deaths
     *
     * @return array
     */
    public function getTotalPve() {
        if(empty($this->pve))
            $this->countPve();

        return $this->pve;
    }

    /**
     * Returns an associative array containing pvp kills and deaths
     *
     * @return array
     */
    public function getTotalPvp() {
        if(empty($this->pvp))
            $this->countPvp();

        return $this->pvp;
    }
}