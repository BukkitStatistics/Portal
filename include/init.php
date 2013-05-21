<?php
define('STARTTIME', (float)array_sum(explode(' ', microtime())));
/*
 * Check for minimum php version
 */
if(version_compare(PHP_VERSION, '5.3.2', '<'))
    die('You need at least PHP 5.3.2!');

/*
 * Define some global constants for better path handling.
 */
define('__ROOT__', dirname(dirname(__FILE__)) . '/');
define('__INC__', __ROOT__ . 'include' . '/');

/*
 * Set development mode
 * Will slow down page load
 */
define('DEVELOPMENT', false);

/*
 * Will save debug messages in cache/debug.txt
 */
define('DEBUG', false);

require __INC__ . 'vendor/autoload.php';
include_once __INC__ . 'config/version.php';
include_once __INC__ . 'loader.php';