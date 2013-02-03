<?php
/*
 * Define some global constants for better path handling.
 */
define('__ROOT__', dirname(dirname(__FILE__)) . '/');
define('__INC__', __ROOT__ . 'yasp' . '/');

include_once __INC__ . '/config/db.php';
include_once __INC__ . 'yasp.php';