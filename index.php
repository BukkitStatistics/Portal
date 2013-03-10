<?php
include_once 'yasp/init.php';

if(file_exists('install.php'))
    fURL::redirect('install.php');

/*
 * Gets the requested page and checks if the page exists or not
 */
$content = fRequest::get('page', NULL, 'overview');
$content .= '.php';

if(!file_exists(__ROOT__ . 'contents/default/' . $content)) {
    fRequest::set('type', 404);
    $content = 'error.php';
}

Util::getCachedContent($content);
Util::newDesign($content);
