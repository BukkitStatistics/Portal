<?php
include_once 'include/init.php';

if(!is_writable('cache/')){
    fRequest::set('type', 500);
    $content = 'error.php';   
}

// only redirect if in production mode
if(!DEVELOPMENT && file_exists('install.php'))
    fURL::redirect('install.php');

/*
 * Gets the requested page and checks if the page exists or not
 */
$content = fRequest::get('page', NULL, 'overview');
$content .= '.php';

if(!is_null(fRequest::get('mod')))
    $content = 'mod/' . fRequest::get('mod') . '.php';

if(!file_exists(__ROOT__ . 'contents/default/' . $content) && is_null(fRequest::get('mod'))) {
    fRequest::set('type', 404);
    $content = 'error.php';
}

$design = new Design('default');
$design->getIndex()->set('title', Util::getOption('portal_title'));
$design->display($content);