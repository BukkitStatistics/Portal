<?php
/*
 * Handles the conflict between xdebug
 * and the flourish debug system
 */
if(!extension_loaded('xdebug')) {
    fCore::enableErrorHandling('html');
    fCore::enableExceptionHandling('html');
}

fSession::setLength('1day');
fSession::open();

/*
 * Initializes the language module
 */
$lang = new Language(fSession::get('lang', 'en')); // @TODO cookies?
$lang->load('errors');
fText::registerComposeCallback('pre', array($lang, 'translate'));

fTimestamp::setDefaultTimezone(Util::getOption('timezone', fTimestamp::getDefaultTimezone()));

/*
 * Initializes ORM
 */
include __INC__ . 'config/orm.php';

/**
 * Automatically includes classes
 *
 *
 * @param  string $class_name  Name of the class to load
 *
 * @throws fEnvironmentException
 * @return void
 */
function __autoload($class_name) {
    $flourish_file = __INC__ . 'flourish/' . $class_name . '.php';
    if(file_exists($flourish_file))
        return require $flourish_file;

    $file = __INC__ . 'classes/' . $class_name . '.php';
    if(file_exists($file))
        return require $file;

    throw new fEnvironmentException('The class ' . $class_name . ' could not be loaded');
}