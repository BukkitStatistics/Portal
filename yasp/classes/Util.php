<?php
class Util {

    // The following constants allow for nice looking callbacks to static methods
    const checkHost = "Util::checkHost";
    const getOption = "Util::getOption";
    const showMessages = "Util::showMessages";
    const addPrefix = "Util::addPrefix";
    const newTpl = "Util::newTpl";

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
     * Returns the requested option out of the settings table
     * If the option does not exist it returns false
     *
     * @param string $option
     *
     * @return string|boolean
     */
    public static function getOption($option) {
        if($option == '')
            return false;

        $db = fORMDatabase::retrieve();
        $res = $db->translatedQuery('SELECT `value` FROM %r WHERE `key` = %s', 'settings', $option);
        try {
            return $res->fetchScalar();
        } catch(fNoRowsException $e) {
            fCore::debug($e);
            return false;
        }
    }

    /**
     * Sets the given option. If it exists, it will be updated. <br> Otherwise a new one will be inserted.
     *
     * @param $option
     * @param $value
     *
     * @return bool
     */public static function setOption($option, $value) {
        if($option == '')
            return false;

        $db = fORMDatabase::retrieve();
        try{
            if(Util::getOption($option))
                $db->translatedExecute('UPDATE %r SET "value"=%s WHERE "key"=%s', 'settings', $value, $option);
            else
                $db->translatedExecute('INSERT INTO %r ("key", "value") VALUES (%s, %s)', 'settings', $option, $value);

            return true;
        } catch(fSQLException $e) {
            fCore::debug($e);
            return false;
        }
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
        if(strrpos(DB_PREFIX, '_') === false)
            $prefix = DB_PREFIX . '_';
        else
            $prefix = DB_PREFIX;

        // if prefix is included skip this statement
        if(strpos($sql, $prefix) !== false)
            return;
        if(strpos($sql, '%r')) {
            if(strpos($values[0], $prefix) !== false)
                return;

            $values[0] = $prefix . $values[0];
        }
        if(preg_match("/^UPDATE `?prefix_\S+`?\s+SET/is", $sql))
            $sql = preg_replace("/^UPDATE `?prefix_(\S+?)`?([\s\.,]|$)/i", "UPDATE `" . $prefix . "\\1`\\2", $sql);
        elseif(preg_match("/^INSERT INTO `?prefix_\S+`?\s+[a-z0-9\s,\)\(]*?VALUES/is", $sql))
            $sql = preg_replace("/^INSERT INTO `?prefix_(\S+?)`?([\s\.,]|$)/i", "INSERT INTO `" . $prefix . "\\1`\\2",
                                $sql);
        else $sql = preg_replace("/prefix_(\S+?)([\s\.,]|$)/", $prefix . "\\1\\2", $sql);

        fCore::debug('addPrefix: ' . $sql);
    }


    /**
     * Sets the tpl variable in the main design.<br>
     * Context is for the most times <b>$this</b>
     *
     * @param fTemplating $context
     * @param String      $tplName
     * @return fTemplating
     */
    public static function newTpl(fTemplating $context, $tplName) {
        $tpl = new fTemplating($context->get('tplRoot'), $tplName . '.tpl');
        $context->set('tpl', $tpl);

        return $tpl;
    }

}
