<?php
// TODO: make sure there are no players currently playing -> shut the server off! :D
if(fSession::get('maxStep') < 5)
    fURL::redirect('?step=four');

$tpl = Util::newTpl($this, 'converter');

if(!is_null(fSession::get('convertDB')))
    $tpl->set('state', 2);

if(fRequest::isPost() && fRequest::get('converter_submit')) {
    if(fRequest::get('start', 'boolean')) {
        $new_conv = array();

        foreach(fRequest::get('convert') as $key => $value) {
            if($value == 'on')
                $new_conv[$key] = true;
        }

        fSession::set('convert', $new_conv);
        fSession::set('maxStep', 6);
        fURL::redirect('?step=process');
    }

    if($tpl->get('state') == null) {
        /*
       * Store input values
       */
        $tpl->set('host', fRequest::encode('host'));
        $tpl->set('user', fRequest::encode('user'));
        $tpl->set('pw', fRequest::encode('pw'));
        $tpl->set('database', fRequest::encode('database'));


        try {
            $vali = new fValidation();


            $vali->addRequiredFields(array(
                                          'host',
                                          'user',
                                          'pw',
                                          'database'
                                     ))
                ->addCallbackRule('host', Util::checkHost, 'Please enter an valid host.');


            $vali->setMessageOrder('type', 'host', 'user', 'pw', 'database')
                ->validate();


            $db = new fDatabase('mysql', $tpl->get('database'),
                                $tpl->get('user'),
                                $tpl->get('pw'),
                                $tpl->get('host'));
            fSession::set('convertDB', array(
                                            'database' => $tpl->get('database'),
                                            'user'     => $tpl->get('user'),
                                            'pw'       => $tpl->get('pw'),
                                            'host'     => $tpl->get('host')
                                       )
            );

            $db->connect();
            $db->close();
            $tpl->set('state', 2);
        } catch(fValidationException $e) {
            fMessaging::create('validation', 'install/converter', $e->getMessage());
        } catch(fConnectivityException $e) {
            fMessaging::create('connectivity', 'install/converter', $e->getMessage());
        } catch(fAuthorizationException $e) {
            fMessaging::create('auth', 'install/converter', $e->getMessage());
        } catch(fNotFoundException $e) {
            fMessaging::create('notfound', 'install/converter', $e->getMessage());
        } catch(fEnvironmentException $e) {
            fMessaging::create('env', 'install/converter', $e->getMessage());
        }
    }

    if($tpl->get('state') == 2) {

        $conv = new Converter($db, fORMDatabase::retrieve());
        $values = $conv->getOldStats();

        foreach($values as $key => $value)
            $tpl->set($key, $value);
    }
}