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

if(DEBUG) {
    fCore::enableDebugging(true);
    fCore::registerDebugCallback(Util::handleDebug);
}

/*
 * Register an ExceptionCallback
 */
fException::registerCallback(Util::exceptionCallback);

/*
 * Open session
 */
fSession::setLength('1day', '1week');
fSession::open();

/*
 * Save active server to session
 */
if(fRequest::check('server'))
    fSession::set('server', fRequest::get('server', 'string'));

/*
 * Define db values
 */
$db_file = '';
if(fSession::get('server'))
    $db_file = __INC__ . 'config/db_' . fSession::get('server', 'string') .'.php';

if(!file_exists($db_file))
    $db_file =  __INC__ . 'config/db.php';

if(file_exists($db_file)) {
    include $db_file;

    fCore::startErrorCapture(E_NOTICE);
    define('DB_HOST', $db_values['host']);
    define('DB_PORT', $db_values['port']);
    define('DB_USER', $db_values['user']);
    define('DB_PW', $db_values['pw']);
    define('DB_DATABASE', $db_values['database']);
    define('DB_PREFIX', $db_values['prefix']);
    define('DB_TYPE', $db_values['type']);
    fCore::stopErrorCapture();
}
else {
    define('DB_HOST', '');
    define('DB_PORT', '');
    define('DB_USER', '');
    define('DB_PW', '');
    define('DB_DATABASE', '');
    define('DB_PREFIX', '');
    define('DB_TYPE', '');

    if(!file_exists(__ROOT__ . 'install.php')) {
        echo fText::compose('It seems the database config file is missing. Be sure the installation process was executed.');
        exit();
    }
}


/*
 * Initialize cache
 */
try {
    $cache = new fCache('directory', __ROOT__ . 'cache/files');
    $cacheSingle = new fCache('file', __ROOT__ . 'cache/singlecache');
    Util::cleanSkinCache();
} catch(fEnvironmentException $e) {
    echo $e->getMessage();
    $e->printTrace();
    exit();
}

/*
 * Initializes ORM
 */
include_once __INC__ . 'orm.php';


/*
 * Initializes the language module
 */
$lang = new Language(Util::getOption('language', fSession::get('lang', 'en')));
$lang->load('errors');
fText::registerComposeCallback('pre', array($lang, 'translate'));

/*
 * Set timezones and time formats
 */
fTimestamp::setDefaultTimezone(Util::getOption('timezone', fTimestamp::getDefaultTimezone()));
if(Util::getOption('time_format', 24) == 24)
    fTimestamp::defineFormat('std', 'H:i - d.m.Y');
else
    fTimestamp::defineFormat('std', 'g:i a - d.m.Y');

fTimestamp::defineFormat('day', 'D d.m.Y');

/*
 * Sets login page for admin panel
 */
fAuthorization::setLoginPage('?page=login');

/*
 * Include ajax call handling
 * Handles for example api calls
 */
include_once __INC__ . 'ajax.php';