<?php
class Util {

    // The following constants allow for nice looking callbacks to static methods
    const getOption = "Util::getOption";
    const showMessages = "Util::showMessages";
    const addPrefix = "Util::addPrefix";
    const formatSeconds = "Util::formatSeconds";
    const clearSkinCache = "Util::clearSkinCache";
    const handleDebug = "Util::handleDebug";
    const exceptionCallback = "Util::exceptionCallback";
    const getRomanNumber = "Util::getRomanNumber";

    /**
     * Returns the requested option out of the settings table.
     * If the option does not exist it returns false or the default value.
     *
     * @param string $option
     *
     * @param null   $default
     *
     * @return string|boolean
     */
    public static function getOption($option, $default = null) {
        global $cacheSingle;
        if($option == '')
            return false;

        $exclude_cache = array('cache.options', 'patched');

        if(!DEVELOPMENT && $cacheSingle->get($option) != null)
            return $cacheSingle->get($option);

        try {
            $db = fORMDatabase::retrieve('name:' . DB_TYPE);
            $res = $db->translatedQuery('SELECT `value` FROM "prefix_settings" WHERE `key` = %s',
                                        $option)->fetchScalar();

            if(!DEVELOPMENT && !in_array($option, $exclude_cache))
                $cacheSingle->set($option, $res, Util::getOption('cache.options', 60 * 10));
        } catch(fNoRowsException $e) {
            fCore::debug($e);
        } catch(fProgrammerException $e) {
            fCore::debug($e);
        } catch(fNotFoundException $e) {
            fCore::debug($e);
        } catch(fSQLException $e) {
            fMessaging::create('critical', '{errors}', $e);
        } catch(fAuthorizationException $e) {
            fMessaging::create('error', '{errors}', $e);
        } catch(fConnectivityException $e) {
            fMessaging::create('error', '{errors}', $e);
        }

        if(isset($res) && $res != '')
            return $res;

        fCore::debug('non set option: ' . $option);

        if($default == null)
            return false;

        return $default;
    }

    /**
     * Sets the given option. If it exists, it will be updated. <br> Otherwise a new one will be inserted.
     *
     * @param $option
     * @param $value
     *
     * @return bool
     */
    public static function setOption($option, $value) {
        global $cacheSingle;
        if($option == '')
            return false;

        try {
            $db = fORMDatabase::retrieve('name:' . DB_TYPE);
            $updated = $db->translatedQuery('UPDATE "prefix_settings" SET "value"=%s WHERE "key"=%s', $value,
                                            $option)->countAffectedRows();
            if($updated <= 0)
                $db->translatedExecute('INSERT INTO "prefix_settings" ("key", "value") VALUES (%s, %s)', $option,
                                       $value);

            if(!DEVELOPMENT)
                $cacheSingle->delete($option);

            return true;
        } catch(fException $e) {
            fCore::debug($e);
        }

        return false;
    }

    /**
     * An wrapper around the fMessaging::show function
     * This adds bootstrap flavour ;)
     *
     * Without any parameters it receives all messages for {default} recipient
     *
     * @param string $name
     * @param string $recipient
     * @param string $class
     *
     * @return void
     */
    public static function showMessages($name = '*', $recipient = '{default}', $class = 'alert') {
        if($recipient != '' && fMessaging::check($name, $recipient)) {
            echo '<div class="' . $class . '">';
            fMessaging::show($name, $recipient);
            echo '</div>';
        }
    }

    /**
     * If DB_PREFIX is defined and not empty it will return the prefix with an _
     *
     * @return string
     */
    public static function getPrefix() {
        $prefix = preg_replace('/_$/', '', DB_PREFIX);

        return $prefix != '' ? $prefix . '_' : '';
    }

    /**
     * Add to the sql query the defined prefix
     * SQL string must contain 'prefix_'!
     *
     * @param fDatabase         $db
     * @param string|fStatement $sql
     * @param array             $values
     *
     * @return void
     */
    public static function addPrefix($db, &$sql, &$values) {
        if(preg_match("/^UPDATE `?prefix_\S+`?\s+SET/is", $sql))
            $sql = preg_replace("/^UPDATE `?prefix_(\S+?)`?([\s\.,]|$)/i", "UPDATE `" . Util::getPrefix() . "\\1`\\2",
                                $sql);
        elseif(preg_match("/^INSERT INTO `?prefix_\S+`?\s+[a-z0-9\s,\)\(]*?VALUES/is", $sql))
            $sql = preg_replace("/^INSERT INTO `?prefix_(\S+?)`?([\s\.,]|$)/i",
                                "INSERT INTO `" . Util::getPrefix() . "\\1`\\2",
                                $sql);
        else $sql = preg_replace("/prefix_(\S+?)([\s\.,]|$)/", Util::getPrefix() . "\\1\\2", $sql);
    }

    /**
     * Returns an nice formatted string of the seconds in this format: dd:hh:mm:ss
     *
     * @param fTimestamp $timestamp
     * @param bool       $seconds
     * @param bool       $minutes
     * @param bool       $hours
     * @param bool       $days
     *
     * @return int|string
     */
    public static function formatSeconds(fTimestamp $timestamp, $seconds = true, $minutes = true, $hours = true,
                                          $days = true) {

        $timestamp = strtotime($timestamp->__toString());

        $s = $timestamp % 60;
        $m = floor(($timestamp % 3600) / 60);
        $h = floor(($timestamp % 86400) / 3600);
        $d = floor($timestamp / 86400);

        if(strlen($s) == 1)
            $s = 0 . $s;
        if(strlen($m) == 1)
            $m = 0 . $m;
        if(strlen($h) == 1)
            $h = 0 . $h;

        if($days)
            return $d . ' ' . $h . ':' . $m . ':' . $s;
        elseif($hours)
            return $h . ':' . $m . ':' . $s;
        elseif($minutes)
            return $m . ':' . $s;
        elseif($seconds)
            return $s;
        else
            return $d . ' ' . $h . ':' . $m . ':' . $s;
    }

    /**
     * Removes all cached skins that have expired.<br>
     * To force cleaning set $force to true.
     *
     * @param boolean $force
     */
    public static function cleanSkinCache($force = false) {
        if(rand(0, 99) == 50 || $force) {
            $dir = new fDirectory(__ROOT__ . 'cache/skins');
            $files = $dir->scan('#\.png$#i');
            $ctime = new fTimestamp('-' . Util::getOption('cache.skins', 60 * 60 * 24) . ' seconds');

            foreach($files as $file) {
                if($ctime->gte($file->getMTime()))
                    $file->delete();
            }

            fCore::debug('cleared skins');
        }
    }

    /**
     * Saves all debug messages except query times in cache/debug.txt<br>
     * If $msg is an array only the first two elements will be displayed
     *
     * @param string|array $msg
     */
    public static function handleDebug($msg) {
        $time = new fTimestamp();
        $head = 'DEBUG Messages (' . $time->format('d.m.Y - H:i:s') . ")\n\n\n";
        static $first = true;

        try {
            $file = new fFile(__ROOT__ . 'cache/debug.txt');
        } catch(fValidationException $e) {
            $file = fFile::create(__ROOT__ . 'cache/debug.txt', '');
        }

        if($first)
            $file->write($head);
        $first = false;

        if(is_string($msg) && stripos($msg, 'query') !== false)
            return;

        if(is_array($msg)) {
            $out = $msg[0];
            $msg = $msg[1];
        }
        else
            $out = '';

        $out .= ' ';

        if($msg instanceof fException)
            $out .= $msg->getMessage() . '\n' . $msg->formatTrace();
        else
            $out .= fCore::dump($msg);

        $file->append($out . "\n\n");
    }

    /**
     * Returns the roman equivalent of an latin number
     *
     * @param int $num
     *
     * @return string
     */
    public static function getRomanNumber($num) {
        $n = intval($num);
        $result = '';

        $lookup = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        );

        foreach($lookup as $roman => $value) {
            $matches = intval($n / $value);
            $result .= str_repeat($roman, $matches);
            $n = $n % $value;
        }

        return $result;
    }

    public static function getFileContents($url, $ajax = false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        if($ajax) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
        }
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public static function getExecTime() {
        return round((float)array_sum(explode(' ', microtime())) - STARTTIME, 4);
    }
}
