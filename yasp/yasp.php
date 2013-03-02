<?php
/*
 * Handles the conflict between xdbeug
 * and the flourish debugsystem
 */
if(!extension_loaded('xdebug')) {
    fCore::enableErrorHandling('html');
    fCore::enableExceptionHandling('html');
}

fSession::setLength('1day');
fSession::open();

/*
 * Initializes the language modul
 */
$lang = new Language(fSession::get('lang', 'en')); // @TODO cookies?
$lang->load('errors');
fText::registerComposeCallback('pre', array($lang, 'translate'));

/*
 * Initializes ORM
 */
if(defined('DB_DATABASE') && DB_DATABASE != '') {
   try {
       $db = new fDatabase('mysql', DB_DATABASE, DB_USER, DB_PW, DB_HOST);

       fORMDatabase::attach($db);
       fORM::mapClassToTable('Player', DB_PREFIX . '_players');

       // adds prefix
       $db->registerHookCallback('unmodified', Util::addPrefix);
   } catch(fException $e) {
       fMessaging::create('errors', '{default}', $e->getMessage());
   }
}

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


    try {
        fORM::defineActiveRecordClass($class_name);
    } catch(fProgrammerException $e) {
        fMessaging::create('errors', '{default}', $e->getMessage());
        return;
    }

    throw new fProgrammerException('The class ' . $class_name . ' could not be loaded');
}