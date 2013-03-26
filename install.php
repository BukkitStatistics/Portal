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

$design = new fTemplating(__ROOT__ . 'installation', './installation/index.php');
$design->set('title', 'Statistics Portal - ' . strtoupper($s));
$design->set('tplRoot', __ROOT__ . 'installation/views');
$design->add('header_additions', '');
$design->inject($step);
$design->place();