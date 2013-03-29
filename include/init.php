<?php
define('STARTTIME', (float)array_sum(explode(' ', microtime())));
/*
 * Define some global constants for better path handling.
 */
define('__ROOT__', dirname(dirname(__FILE__)) . '/');
define('__INC__', __ROOT__ . 'include' . '/');

/*
 * Set development mode
 * Will slow down page load
 */
define('DEVELOPMENT', true);

/*
 * Will save debug messages in cache/debug.txt
 */
define('DEBUG', true);

include_once __INC__ . 'config/version.php';
include_once __INC__ . 'config/db.php';
include_once __INC__ . 'loader.php';