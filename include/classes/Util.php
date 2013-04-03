<?php
class Util {

    // The following constants allow for nice looking callbacks to static methods
    const getOption = "Util::getOption";
    const showMessages = "Util::showMessages";
    const addPrefix = "Util::addPrefix";
    const newTpl = "Util::newTpl";
    const getCachedContent = "Util::getCachedContent";
    const newDesign = "Util::newDesign";
    const formatSeconds = "Util::formatSeconds";
    const clearSkinCache = "Util::clearSkinCache";
    const handleDebug = "Util::handleDebug";
    const exceptionCallback = "Util::exceptionCallback";

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

        if(!DEVELOPMENT && $cacheSingle->get($option) != null)
            return $cacheSingle->get($option);

        try {
            $db = fORMDatabase::retrieve();
            $res = $db->translatedQuery('SELECT `value` FROM "prefix_settings" WHERE `key` = %s', $option)->fetchScalar();

            if(!DEVELOPMENT && $option != 'cache.options')
                $cacheSingle->set($option, $res, Util::getOption('cache.options', 60 * 10));
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fProgrammerException $e) {
            fCore::debug($e->getMessage());
        } catch(fNotFoundException $e) {
            fCore::debug($e->getMessage());
        } catch(fSQLException $e) {
            fMessaging::create('critical', '{errors}', $e);
        } catch(fAuthorizationException $e) {
            fMessaging::create('error', '{errors}', $e);
        } catch(fConnectivityException $e) {
            fMessaging::create('error', '{errors}', $e);
        }

        if(isset($res) && !empty($res))
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
            $db = fORMDatabase::retrieve();
            $updated = $db->translatedQuery('UPDATE "prefix_settings" SET "value"=%s WHERE "key"=%s', $value,
                                            $option)->countAffectedRows();
            if($updated <= 0)
                $db->translatedExecute('INSERT INTO "prefix_settings" ("key", "value") VALUES (%s, %s)', $option, $value);

            if(!DEVELOPMENT)
                $cacheSingle->delete($option);

            return true;
        } catch(fSQLException $e) {
            fCore::debug($e->getMessage());
        } catch(fProgrammerException $e) {
            fCore::debug($e->getMessage());
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
     * Sets the tpl variable in the main design.<br>
     * Context is for the most times <b>$this</b>
     *
     * @param fTemplating $context
     * @param String      $tplName
     * @param string      $tplKey
     *
     * @return fTemplating
     */
    public static function newTpl(fTemplating $context, $tplName, $tplKey = 'tpl') {
        $tpl = new fTemplating($context->get('tplRoot'), $tplName . '.tpl');
        $context->set($tplKey, $tpl);

        return $tpl;
    }


    /**
     * This will output the main content! If the $content is cached the cached content will be echoed.
     *
     * @param $content
     */
    public static function newDesign($content) {
        global $cache, $lang;

        $error = false;

        fBuffer::startCapture();
        $design = new fTemplating(__ROOT__ . 'contents/default', __ROOT__ . 'templates/default/index.php');
        $design->set('title', Util::getOption('portal_title'));
        $design->set('lang', $lang);
        $design->set('cache', $cache);
        $design->set('tplRoot', __ROOT__ . 'templates/default/views');
        $design->add('header_additions', '');
        try {
            $design->inject($content);
        } catch(fException $e) {
            fCore::debug('design error: ' . $e->getMessage());

            if(fRequest::isAjax())
                die('ajax_error');

            if(!fMessaging::check('*', '{errors}'))
                fMessaging::create('critical', '{errors}', $e);
        }
        if(fMessaging::check('*', '{errors}')) {
            $error = true;
            $design->inject('error.php');
        }

        $design->place();
        $capture = fBuffer::stopCapture();

        echo $capture;

        if(fRequest::get('name', 'string') != '' && $content != 'error.php')
            $content = $content . '_' . fRequest::get('name', 'string');

        if(!DEVELOPMENT
           && !is_null($cache)
           && !$error
           && !fRequest::isAjax()
           && !fMessaging::check('*', '{errors}')
           && !fMessaging::check('no-cache', '{cache}')
           && $content != 'error.php') {
            if($cache->set($content . '.cache', $capture, Util::getOption('cache.pages', 60)))
                fCore::debug('cached for ' . Util::getOption('cache.pages', 60) . ' seconds: ' . $content);
        }


        fMessaging::retrieve('no-cache', '{cache}');
    }


    /**
     * Gets the cached file.<br>
     * If one exists it searches for an small tag with id="execution_time" <br>
     * and replaces the contents with 'cached (filetime)'.
     *
     * @param        $content
     *
     * @internal param \fCache $cache
     */
    public static function getCachedContent($content) {
        global $cache;

        if(DEVELOPMENT || fMessaging::check('*', '{errors}'))
            return;

        if(fRequest::get('name', 'string') != '' && $content != 'error.php')
            $content = $content . '_' . fRequest::get('name', 'string');

        $cached = $cache->get($content . '.cache');

        if($cached == null)
            return;

        fCore::debug('returned cached: ' . $cached);

        try {
            $file = new fFile(__ROOT__ . 'cache/files/' . $content . '.cache');
            $time = $file->getMTime();
            $text = '
                <small>
                    <em>cached (' . $time->format('H:i:s') . ')</em>
                </small>
             ';
            $cached = preg_replace('%<small .*id="execution_time".*>(.*)</small>%si', $text, $cached);
        } catch(fValidationException $e) {
        }

        exit($cached);
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
    public static function  formatSeconds(fTimestamp $timestamp, $seconds = true, $minutes = true, $hours = true,
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
     * Saves all debug messages except query times in cache/debug.txt
     *
     * @param $msg
     */
    public static function handleDebug($msg) {
        $time = new fTimestamp();
        $head = 'DEBUG Messages (' . $time->format('d.m.Y - H:i:s') . ")\n\n\n";
        static $first = true;

        try {
            $file = new fFile(__ROOT__ . 'cache/debug.txt');
        } catch (fValidationException $e) {
            $file = fFile::create(__ROOT__ . 'cache/debug.txt', '');
        }
        if($first)
            $file->write($head);
        $first = false;

        if(is_string($msg) && stripos($msg, 'query') !== false)
            return;

        $file->append(fCore::dump($msg) . "\n\n");
    }

    /**
     * Will be called when an exception occurred.
     *
     * @param fException $type
     */
    public static function exceptionCallback($type) {
        global $cache;

        // delete overview when player not found -> could be caused by an outdated cached overview page
        if($type instanceof fNotFoundException && fRequest::get('page', 'string') == 'player') {
            if($cache->get('overview.php.cache'))
                $cache->delete('overview.php.cache');
        }

        fCore::debug('exception call: ' . $type);
    }
}
