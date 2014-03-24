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
    const convertBytes = "Util::convertBytes";
    const formatMinecraftString = "Util::formatMinecraftString";
    const getDatabase = "Util::getDatabase";



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
        static $runtime_cache = array();

        if($option == '')
            return false;

        if(isset($runtime_cache[$option]))
            return $runtime_cache[$option];

        try {
            $db = self::getDatabase();
            $res = $db->translatedQuery('SELECT `value` FROM "prefix_settings" WHERE `key` = %s',
                                        $option)->fetchScalar();

            $runtime_cache[$option] = $res;
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
        if($option == '')
            return false;

        try {
            $db = self::getDatabase();
            $updated = $db->translatedQuery('UPDATE "prefix_settings" SET "value"=%s WHERE "key"=%s', $value,
                                            $option)->countAffectedRows();
            if($updated <= 0)
                $db->translatedExecute('INSERT INTO "prefix_settings" ("key", "value") VALUES (%s, %s)', $option,
                                       $value);

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
     * Returns an nice formatted string of the seconds in this format: y d h m s
     *
     * @param fTimestamp $ftimestamp
     * @param bool       $years
     * @param bool       $days
     * @param bool       $hours
     * @param bool       $minutes
     * @param bool       $seconds
     *
     * @return string
     */
    public static function formatSeconds(fTimestamp $ftimestamp, $years = true, $days = true, $hours = true,
                                         $minutes = true, $seconds = true) {
        // TODO: improve function.. again...

        $timestamp = strtotime($ftimestamp->__toString());

        if($ftimestamp->eq(new fTimestamp()))
            $timestamp = 0;

        $units = array(
            'y' => 365 * 24 * 3600,
            'd' => 24 * 3600,
            'h' => 3600,
            'm' => 60,
            's' => 1,
        );

        // specifically handle zero
        if($timestamp == 0)
            return '0s';

        $s = '';

        foreach($units as $name => $divisor) {
            if($quot = intval($timestamp / $divisor)) {
                    $quot = sprintf('%02d', $quot);

                $s .= $quot . $name . ' ';
                $timestamp -= $quot * $divisor;
            }
        }

        return substr($s, 0, -1);
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

    public static function exceptionCallback($exception) {
        global $cache;

        if($cache == null)
            return;

        if($exception instanceof fProgrammerException) {
            if($cache->get('remapped_' . DB_TYPE))
                $cache->delete('remapped_' . DB_TYPE);
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

    /**
     * Gets the file contents via curl.
     *
     * @param      $url
     * @param bool $ajax
     *
     * @return mixed
     */
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

    /**
     * Returns the execution time of the whole script.
     *
     * @return float
     */
    public static function getExecTime() {
        return round((float)array_sum(explode(' ', microtime())) - STARTTIME, 4);
    }

    /**
     * Returns the active database
     *
     * @param string $type defaults to DB_TYPE
     *
     * @return fDatabase
     */
    public static function getDatabase($type = DB_TYPE) {
        return fORMDatabase::retrieve('name:' . $type);
    }

    /**
     * Convert bytes to human readable format
     *
     * @param     $bytes - size in bytes to convert
     * @param int $precision
     *
     * @return string
     */
    public static function convertBytes($bytes, $precision = 2) {
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;

        if(($bytes >= 0) && ($bytes < $kilobyte)) {
            return $bytes . ' B';

        }
        elseif(($bytes >= $kilobyte) && ($bytes < $megabyte)) {
            return sprintf('%.2f', round($bytes / $kilobyte, $precision)) . ' KB';

        }
        elseif(($bytes >= $megabyte) && ($bytes < $gigabyte)) {
            return sprintf('%.2f', round($bytes / $megabyte, $precision)) . ' MB';

        }
        elseif(($bytes >= $gigabyte) && ($bytes < $terabyte)) {
            return sprintf('%.2f', round($bytes / $gigabyte, $precision)) . ' GB';

        }
        elseif($bytes >= $terabyte) {
            return sprintf('%.2f', round($bytes / $terabyte, $precision)) . ' TB';
        }
        else {
            return $bytes . ' B';
        }
    }

    /**
     * Returns an html equivalent to the minecraft formatting codes.
     *
     * @param $string
     *
     * @return string
     */
    public static function formatMinecraftString($string) {
        $str = preg_replace_callback('%§([a-fk-or0-9])%i', 'self::motdReplaceCallback', $string);
        $openspan = substr_count($str, '<span');
        $closespan = substr_count($str, '</span>');

        for($i = 0; $i < $openspan - $closespan; $i++)
            $str .= '</span>';

        return $str;
    }

    /**
     * Helper function for formatMinecraftString.<br>
     * Replaces all formatting codes with an appropriated span element
     *
     * @param $match
     *
     * @return string
     */
    private static function motdReplaceCallback($match) {
        static $count = 0;

        $codes = array(
            '0' => 'color: #000000',
            '1' => 'color: #0000AA',
            '2' => 'color: #00AA00',
            '3' => 'color: #00AAAA',
            '4' => 'color: #AA0000',
            '5' => 'color: #AA00AA',
            '6' => 'color: #FFAA00',
            '7' => 'color: #AAAAAA',
            '8' => 'color: #555555',
            '9' => 'color: #5555FF',
            'a' => 'color: #55FF55',
            'b' => 'color: #55FFFF',
            'c' => 'color: #FF5555',
            'd' => 'color: #FF55FF',
            'e' => 'color: #FFFF55',
            'f' => 'color: #FFFFFF',
            'l' => 'font-weight: bold;',
            'm' => 'text-decoration: line-through;',
            'n' => 'text-decoration: underline;',
            'o' => 'font-style: italic;'
        );


        if(isset($codes[$match[1]])) {
            $count++;
            return '<span style="' . $codes[$match[1]] . '">';
        }
        elseif($match[1] == 'r') {
            $tmp = '';
            for($i = 0; $i < $count; $i++)
                $tmp .= '</span>';

            $count = 0;

            return $tmp;
        }

        return '';
    }
}
