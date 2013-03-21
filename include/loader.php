<?php
/*
 * Handles the conflict between xdebug
 * and the flourish debug system
 */
if(!extension_loaded('xdebug')) {
    if(DEVELOPMENT) {
        fCore::enableErrorHandling('html');
        fCore::enableExceptionHandling('html');
    }
}

fSession::setLength('1day');
fSession::open();

/*
 * Initialize cache
 */
try {
    $cache = new fCache('directory', __ROOT__ . 'cache/files');
    $cacheSingle = new fCache('file', __ROOT__ . 'cache/singlecache');
    Util::cleanSkinCache();
} catch(fEnvironmentException $e) {
    fMessaging::create('critical', '{errors}', $e);
    Util::newDesign('error.php');
    die();
}

/*
 * Initializes ORM
 */
include __INC__ . 'config/orm.php';

/*
 * Include ajax call handling
 * Handles for example api calls
 */
include __INC__ . 'ajax.php';

/*
 * Initializes the language module
 */
$lang = new Language(Util::getOption('language', fSession::get('lang', 'en')));
$lang->load('errors');
fText::registerComposeCallback('pre', array($lang, 'translate'));

fTimestamp::setDefaultTimezone(Util::getOption('timezone', fTimestamp::getDefaultTimezone()));

fAuthorization::setLoginPage('?page=login');
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

    $file = __INC__ . 'classes/orm/' . $class_name . '.php';
    if(file_exists($file))
        return require $file;

    throw new fEnvironmentException('The class ' . $class_name . ' could not be loaded');
}