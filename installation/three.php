<?php // @TODO more settings?!
if(fSession::get('maxStep') < 3)
    fURL::redirect('?step=two');

$tpl = Util::newTpl($this, 'three');

$tpl->set('adminpw', fRequest::encode('adminpw'));
$tpl->set('title', fSession::get('settings[title]'));

if(fRequest::isPost() && fRequest::get('general_submit')) {
    /*
    * store input values
    */
    fSession::set('settings[title]', fRequest::encode('title'));

    try {
        $vali = new fValidation();

        $vali->addRequiredFields(array(
                                      'adminpw',
                                      'title'
                                 ))
            ->overrideFieldName('adminpw', 'Admin Password')
            ->validate();

        Util::setOption('adminpw', $tpl->get('adminpw'));
        Util::setOption('portal_title', $tpl->get('title'));
        Util::setOption('language', fSession::get('lang'));

    } catch(fValidationException $e) {
        fMessaging::create('validation', 'install/three', $e->getMessage());
    } catch(fConnectivityException $e) {
        fMessaging::create('connectivity', 'install/three', $e->getMessage());
    } catch(fAuthorizationException $e) {
        fMessaging::create('auth', 'install/three', $e->getMessage());
    } catch(fNotFoundException $e) {
        fMessaging::create('notfound', 'install/three', $e->getMessage());
    } catch(fSQLException $e) {
        fMessaging::create('sql', 'install/three', $e->getMessage());
    }

    if(!fMessaging::check('*', 'install/three')) {
        fSession::set('maxStep', 4);
        fURL::redirect('?step=four');
    }
}
