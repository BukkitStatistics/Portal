<?php
include_once 'include/init.php';

/*
 * Gets the requested page and checks if the page exists or not
 */
$step = fRequest::get('step', NULL, 'one');
$s = $step;
$step .= '.php';

if(!file_exists(__ROOT__ . 'installation/' . $step))
    $step = 'error.php';

fMessaging::create('no-cache', '{cache}', true);

$ar = array('one', 'two', 'three', 'four', 'converter', 'process', 'five');
$design = new Design('default', __ROOT__ . 'installation/', __ROOT__ . 'installation/views/');
$design->getIndex()->set('title', 'Statistics Portal - ' . strtoupper($s));
$design->getIndex()->set('install_pos', array_search(fRequest::get('step', 'string', 'one'), $ar));
$design->display($step);