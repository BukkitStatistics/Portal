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
        $res = Util::getDatabase()->translatedQuery('
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

    public static function getId($name) {
        $res = Util::getDatabase()->translatedQuery('
            SELECT player_id
            FROM "prefix_players"
            WHERE name = %s
            ', $name);

        try {
            return $res->fetchScalar();
        } catch(fNoRowsException $e) {
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

        $res = Util::getDatabase()->translatedQuery($sql);

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
        $res = Util::getDatabase()->translatedQuery('
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
        $res = Util::getDatabase()->translatedQuery('
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
        $res = Util::getDatabase()->translatedQuery('
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
        $des = 0;
        $pld = 0;

        try {
            $row = Util::getDatabase()->translatedQuery(
                       'SELECT SUM(destroyed) AS des, SUM(placed) AS pld
                       FROM prefix_total_blocks
                       WHERE player_id = %i',
                       $this->getPlayerId()
                   )->fetchRow();

            $des = is_null($row['des']) ? 0 : $row['des'];
            $pld = is_null($row['pld']) ? 0 : $row['pld'];
        } catch(fSQLException $e) {
        }

        $this->blocks['destroyed'] = new fNumber($des);
        $this->blocks['placed'] = new fNumber($pld);
    }

    /**
     * Counts all items
     */
    private function countItems() {
        $pic = 0;
        $drp = 0;

        try {
            $row = Util::getDatabase()->translatedQuery(
                       'SELECT SUM(dropped) AS drp, SUM(picked_up) AS pic
                       FROM prefix_total_items
                       WHERE player_id = %i',
                       $this->getPlayerId()
                   )->fetchRow();

            $pic = is_null($row['pic']) ? 0 : $row['pic'];
            $drp = is_null($row['drp']) ? 0 : $row['drp'];
        } catch(fSQLException $e) {
        }

        $this->items['picked'] = new fNumber($pic);
        $this->items['dropped'] = new fNumber($drp);
    }

    /**
     * Counts all pve kills
     */
    private function countPve() {
        $kills = 0;
        $deaths = 0;

        try {
            $row = Util::getDatabase()->translatedQuery(
                       'SELECT SUM(player_killed) AS deaths, SUM(creature_killed) AS kills
                       FROM prefix_total_pve_kills
                       WHERE player_id = %i',
                       $this->getPlayerId()
                   )->fetchRow();

            $kills = is_null($row['kills']) ? 0 : $row['kills'];
            $deaths = is_null($row['deaths']) ? 0 : $row['deaths'];
        } catch(fSQLException $e) {
        }

        $this->pve['kills'] = new fNumber($kills);
        $this->pve['deaths'] = new fNumber($deaths);
    }

    /**
     * Counts all pvp kills
     */
    private function countPvp() {
        $kills = 0;
        $deaths = 0;

        try {
            $row = Util::getDatabase()->translatedQuery(
                       'SELECT (
                       SELECT SUM(times)
                       FROM prefix_total_pvp_kills
                       WHERE victim_id = %i
                       ) AS deaths,
                       (
                       SELECT SUM(times)
                       FROM prefix_total_pvp_kills
                       WHERE player_id = %i
                       ) AS kills',
                       $this->getPlayerId(),
                       $this->getPlayerId()
                   )->fetchRow();

            $kills = is_null($row['kills']) ? 0 : $row['kills'];
            $deaths = is_null($row['deaths']) ? 0 : $row['deaths'];
        } catch(fSQLException $e) {
        }

        $this->pvp['kills'] = new fNumber($kills);
        $this->pvp['deaths'] = new fNumber($deaths);
    }

    private function getSkin() {
    	$skinUrl = 'http://skins.minecraft.net/MinecraftSkins/' . $this->getName() . '.png';
        $headers = get_headers($skinUrl, 1);
        if(isset($headers[1]) && isset($headers['Content-Type'][1]) && $headers['Content-Type'][1] == 'image/png') {
            $path = $skinUrl;
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
        $name = 'cache/skins/head-' . $size . '_' . $this->getUrlName() . '.png';

        if(!file_exists($name) || Util::getOption('cache.skins', 60 * 60 * 24) == 0) {
            $canvas = imagecreatetruecolor($size, $size);
            $image = imagecreatefromstring(file_get_contents($this->getSkin()));
            imagecopyresampled($canvas, $image, 0, 0, ImageSX($image) / 8, ImageSX($image) / 8, $size, $size,
                               ImageSX($image) / 8, ImageSX($image) / 8);
            imagecopyresampled($canvas, $image, 0, 0, (ImageSX($image) / 8) * 5, ImageSX($image) / 8, $size, $size,
                               ImageSX($image) / 8, ImageSX($image) / 8); //support of hair

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
               '" title="' . $this->getName() . '" ' . $tooltip . ' style="width: ' . $size . 'px; height: ' . $size . 'px">';
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