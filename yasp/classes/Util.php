<?php
class Util {

    // The following constants allow for nice looking callbacks to static methods
    const checkHost = "Util::checkHost";
    const getOption = "Util::getOption";
    const showMessages = "Util::showMessages";
    const addPrefix = "Util::addPrefix";
    const newTpl = "Util::newTpl";
    const getCachedContent = "Util::getCachedContent";

    /**
     * Checks if the given host is an valid IP or localhost
     *
     * @param $host
     *
     * @return bool
     */
    public static function checkHost($host) {
        if(strtolower($host) == 'localhost')
            return true;
        elseif(preg_match('%^([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])$%',
                          $host)
        )
            return true;
        else return false;
    }


    /**
     * Returns the requested option out of the settings table.
     * If the option does not exist it returns false or the default value.
     *
     * @param string $option
     *
     * @return string|boolean
     */
    public static function getOption($option, $default = null) {
        global $cacheSingle;
        if($option == '')
            return false;

        if(!DEVELOPMENT && $cacheSingle->get($option) != null)
            return $cacheSingle->get($option);

        try {
            $db = fORMDatabase::retrieve();
            $res = $db->translatedQuery('SELECT `value` FROM %r WHERE `key` = %s', 'settings', $option)->fetchScalar();

            // temporary: cache for 10 minutes
            // TODO: set cache time in settings + reset on db change!
            if(!DEVELOPMENT)
                $cacheSingle->set($option, $res, 60 * 10);

            return $res;
        } catch(fNoRowsException $e) {
            fCore::debug($e);
        } catch(fProgrammerException $e) {
            fCore::debug($e);
        } catch(fNotFoundException $e) {
            fCore::debug($e);
        }

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
            $db = fORMDatabase::retrieve();
            $updated = $db->translatedQuery('UPDATE %r SET "value"=%s WHERE "key"=%s', 'settings', $value,
                                            $option)->countAffectedRows();
            if($updated <= 0)
                $db->translatedExecute('INSERT INTO %r ("key", "value") VALUES (%s, %s)', 'settings', $option, $value);

            if(!DEVELOPMENT)
                $cacheSingle->delete($option);

            return true;
        } catch(fSQLException $e) {
            fCore::debug($e);
        } catch(fProgrammerException $e) {
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
     * Add to the sql query the defined prefix
     * SQL string must contain 'prefix_' or the placeholder %r!
     *
     * @param fDatabase         $db
     * @param string|fStatement $sql
     * @param array             $values
     *
     * @return void
     */
    public static function addPrefix($db, &$sql, &$values) {
        if(DB_PREFIX != '')
            $prefix = DB_PREFIX . '_';
        else
            $prefix = '';
        // if prefix is included skip this statement
        if(strpos($sql, DB_PREFIX) !== false)
            return;
        if(strpos($sql, '%r')) {
            if(strpos($values[0], DB_PREFIX) !== false)
                return;

            $values[0] = $prefix . $values[0];
        }
        if(preg_match("/^UPDATE `?prefix_\S+`?\s+SET/is", $sql))
            $sql = preg_replace("/^UPDATE `?prefix_(\S+?)`?([\s\.,]|$)/i", "UPDATE `" . $prefix . "\\1`\\2", $sql);
        elseif(preg_match("/^INSERT INTO `?prefix_\S+`?\s+[a-z0-9\s,\)\(]*?VALUES/is", $sql))
            $sql = preg_replace("/^INSERT INTO `?prefix_(\S+?)`?([\s\.,]|$)/i", "INSERT INTO `" . $prefix . "\\1`\\2",
                                $sql);
        else $sql = preg_replace("/prefix_(\S+?)([\s\.,]|$)/", $prefix . "\\1\\2", $sql);
    }


    /**
     * Sets the tpl variable in the main design.<br>
     * Context is for the most times <b>$this</b>
     *
     * @param fTemplating $context
     * @param String      $tplName
     *
     * @return fTemplating
     */
    public static function newTpl(fTemplating $context, $tplName) {
        $tpl = new fTemplating($context->get('tplRoot'), $tplName . '.tpl');
        $context->set('tpl', $tpl);

        return $tpl;
    }


    /**
     * Gets the cached file.<br>
     * If one exists it searches for an small tag with id="execution_time" <br>
     * and replaces the contents with 'cached (filetime)'.
     *
     * @param        $content
     * @param fCache $cache
     */
    public static function getCachedContent($content) {
        global $cache;
        if(DEVELOPMENT)
            return;

        $cached = $cache->get($content . '.cache');

        if($cached == null)
            return;

        $file = new fFile(__ROOT__ . 'cache/' . $content . '.cache');
        $time = $file->getMTime();
        $text = '
            <div class="row-fluid">
                <div class="span4 offset8">
                    <small>
                        <em>cached (' . $time->format('H:i:s') . ')</em>
                    </small>
                </div>
             </div>
         </bod>';
        $cached = preg_replace('%<small.*id="execution_time">(.*)</small>%si', $text, $cached);

        die($cached);
    }

    public static function  formatSeconds($timestamp, $seconds = true, $minutes = true, $hours = true, $days = true) {
        $s = $timestamp % 60;
        $m = floor(($timestamp % 3600) / 60);
        $h = floor(($timestamp % 86400) / 3600);
        $d = floor($timestamp / 86400);

        if(strlen($s) == 1)
            $s .= 0;

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

}
