<?php
include_once 'yasp/init.php';

if(file_exists('install.php'))
    fURL::redirect('install.php');

/*
 * Gets the requested page and checks if the page exists or not
 */
$content = fRequest::get('page', NULL, 'overview');
$content .= '.php';

if(!file_exists(__ROOT__ . 'contents/default/' . $content))
    $content = 'error.php';

$design = new fTemplating(__ROOT__ . 'contents/default', './templates/default/index.php');
$design->set('title', Util::getOption('portal_title'));
$design->set('tplRoot', __ROOT__ . 'templates/default/views');
$design->add('header_additions', '');
$design->inject($content);
$design->place();