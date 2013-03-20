<?php
/**
 * This class represents an single player in the players table.
 */
class Player extends fActiveRecord {

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
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        } catch(fValidationException $e) {
            fCore::debug($e->getMessage());
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
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        } catch(fValidationException $e) {
            fCore::debug($e->getMessage());
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
        } catch(fNoRowsException $e) {
        } catch(fNotFoundException $e) {
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
        } catch(fNoRowsException $e) {
        } catch(fNotFoundException $e) {
        }

        $p = new Player();
        return array(0, $p->setName('none'));
    }

    /**
     * Returns the url friendly name
     *
     * @return string
     */
    public function getUrlName() {
        return fURL::makeFriendly($this->getName());
    }


    private function getSkin() {
        $headers = get_headers('http://s3.amazonaws.com/MinecraftSkins/' . $this->getName() . '.png');
        if(isset($headers[7]) &&
           ($headers[7] == 'Content-Type: image/png' || $headers[7] == 'Content-Type: application/octet-stream')
        ) {
            $path = 'http://s3.amazonaws.com/MinecraftSkins/' . $this->getName() . '.png';
        }
        else {
            $path = 'http://s3.amazonaws.com/MinecraftSkins/char.png';
        }

        return $path;
    }

    /**
     * Returns the html code to the player head image.<br>
     * If no image was found it will return the default image.
     *
     * @param int    $size
     * @param String $classes
     *
     * @return mixed
     */
    public function getPlayerHead($size = 32, $classes = null) {
        $name = __ROOT__ . 'cache/skins/head-' . $size . '_' . $this->getUrlName() . '.png';

        if(!file_exists($name)) {
            $canvas = imagecreatetruecolor($size, $size);
            $image = imagecreatefromstring(file_get_contents($this->getSkin()));
            imagecopyresampled($canvas, $image, 0, 0, 8, 8, $size, $size, 8, 8);

            imagepng($canvas, $name);
        }


        if(!is_null($classes))
            $class = 'class="' . $classes . '"';
        else
            $class = '';

        return '<img ' . $class . ' src="' . fFilesystem::translateToWebPath($name) . '" alt="' . $this->getName() .
               '" title="' .
               $this->getName() . '">';
    }
}