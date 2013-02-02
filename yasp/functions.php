<?php // TODO move to util class?
function checkHost($value) {
    if(strtolower($value) == 'localhost')
        return true;
    elseif(preg_match('%^([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])$%',
                      $value)
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
function get_option($option) {
    if($option == '')
        return false;

    $db = fORMDatabase::retrieve();
    $res = $db->translatedQuery('SELECT "value" FROM %r WHERE "key" = %s', 'settings', $option);
    try {
        return $res->fetchScalar();
    } catch(fNoRowsException $e) {
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
function show_messages($name = '*', $recipient = '{default}', $class = 'alert') {
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
function add_prefix($db, &$sql, &$values) {
    // if prefix is included skip this statement
    if(strpos($sql, DB_PREFIX) !== false)
        return;
    if(strpos($sql, '%r'))
        $values[0] = DB_PREFIX . $values[0];
    if(preg_match("/^UPDATE `?prefix_\S+`?\s+SET/is", $sql))
        $sql = preg_replace("/^UPDATE `?prefix_(\S+?)`?([\s\.,]|$)/i", "UPDATE `" . DB_PREFIX . "\\1`\\2", $sql);
    elseif(preg_match("/^INSERT INTO `?prefix_\S+`?\s+[a-z0-9\s,\)\(]*?VALUES/is", $sql))
        $sql = preg_replace("/^INSERT INTO `?prefix_(\S+?)`?([\s\.,]|$)/i", "INSERT INTO `" . DB_PREFIX . "\\1`\\2",
                            $sql);
    else $sql = preg_replace("/prefix_(\S+?)([\s\.,]|$)/", DB_PREFIX . "\\1\\2", $sql);

    fCore::debug($sql);
}