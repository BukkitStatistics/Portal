<?php
include_once 'include/init.php';

// only redirect if in production mode
if(!file_exists(__INC__ . 'config/db.php') && file_exists('install.php'))
    fURL::redirect('install.php');

/*
 * Gets the requested page and checks if the page exists or not
 */
$content = fRequest::get('page', NULL, 'overview');
$cex = preg_split('%(/|\\\)%', $content);
$content = isset($cex[0]) ? $cex[0] : $content;
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