<?php
// TODO: make sure there are no players currently playing -> shut the server off! :D
// TODO: complete new converter class -> progress bar: first output tpl with 0% then call script -> return after a certain amount of queries -> output percentage
// if js is on do ajax calls -> no output, just percantage output -> recall ajax until 100%
if(fSession::get('maxStep') < 5)
    fURL::redirect('?step=four');

$tpl = Util::newTpl($this, 'converter');

if(fRequest::isPost() && fRequest::get('converter_submit')) {
    if(fRequest::get('start', 'boolean')) {
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
        // remove old messages from session
        fMessaging::retrieve('*', 'install/converter');

        $conv = new Converter($db, fORMDatabase::retrieve());
        $values = $conv->getOldStats();

        foreach($values as $key => $value)
            $tpl->set($key, $value);
    }
}