<?php
if(fSession::get('maxStep') < 2)
    fURL::redirect('?step=one');

$tpl = Util::newTpl($this, 'two');

/*
 * Validates the database data
 */
if(fRequest::isPost() && fRequest::get('db_submit')) {
    /*
     * Store input values
     */
    $tpl->set('host', fRequest::encode('host'));
    $tpl->set('user', fRequest::encode('user'));
    $tpl->set('pw', fRequest::get('pw', 'string?'));
    $tpl->set('database', fRequest::encode('database'));
    $tpl->set('port', fRequest::encode('port'));
    $tpl->set('prefix', fRequest::encode('prefix'));
    try {
        $vali = new fValidation();

        $vali->addRequiredFields(array(
                                      'host',
                                      'port',
                                      'user',
                                      'database'
                                 ));

        $vali->setMessageOrder('host', 'port', 'user', 'pw', 'database')
            ->validate();

        $tpl->set('prefix', preg_replace('/_$/', '', $tpl->get('prefix')));

        if($tpl->get('prefix') != '')
            $prefix = $tpl->get('prefix') . '_';
        else
            $prefix = '';

        $db = new fDatabase('mysql', fRequest::encode('database'),
                            fRequest::encode('user'),
                            fRequest::encode('pw'),
                            fRequest::encode('host'),
                            fRequest::encode('port')
        );
        $db->connect();
        $version = $db->translatedQuery(
            'SELECT `value` FROM "' . $prefix . 'settings" WHERE `key` = %s', 'version')->fetchScalar();
        if($version < 2)
            throw new fSQLException();
        $db->close();
    } catch(fValidationException $e) {
        fMessaging::create('validation', 'install/two', $e->getMessage());
    } catch(fConnectivityException $e) {
        fMessaging::create('connectivity', 'install/two', $e->getMessage());
    } catch(fAuthorizationException $e) {
        fMessaging::create('auth', 'install/two', $e->getMessage());
    } catch(fNotFoundException $e) {
        fMessaging::create('notfound', 'install/two', $e->getMessage());
    } catch(fEnvironmentException $e) {
        fMessaging::create('env', 'install/two', $e->getMessage());
    } catch(fProgrammerException $e) {
        fMessaging::create('prog', 'install/two', $e->getMessage());
    } catch(fSQLException $e) {
        fMessaging::create('nodb', 'install/two', fText::compose('No Database found'));
    }

    try {
        // checking db.php
        $db_file = new fFile(__INC__ . 'config/db.php');

        if(!fMessaging::check('validation', 'install/two')) {
            $contents = "<?php
/*
* Do not modify this unless you know what you are doing!
*/

\$db_values = array(
    'host'     => '" . $tpl->get('host') . "',
    'port'     => '" . $tpl->get('port') . "',
    'user'     => '" . $tpl->get('user') . "',
    'pw'       => '" . $tpl->get('pw') . "',
    'database' => '" . $tpl->get('database') . "',
    'prefix'   => '" . $tpl->get('prefix') . "',
    'type'     => 'default'
);";

            $db_file->write($contents);
        }
    } catch(fValidationException $e) {
        fMessaging::create('db_file', 'install/two', $e->getMessage());
    }
    if(!fMessaging::check('*', 'install/two')) {
        fSession::set('maxStep', 3);
        fURL::redirect('?step=three');
    }
}