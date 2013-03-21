<?php
fMessaging::create('no-cache', '{cache}', true);
$tpl = Util::newTpl($this, 'login');

if(fRequest::get('signin') && fRequest::isPost()) {
    /*
     * Store input values
     */
    $tpl->set('email', fRequest::get('email', 'string'));

    try {
        $vali = new fValidation();
        $vali->addRequiredFields(
            'email',
            'pw'
        )
        ->addEmailFields('email');

        $vali->overrideFieldName(array(
                                      'email' => 'E-Mail',
                                      'pw'    => 'Password'
                                 ));

        $vali->validate();

        if(fRequest::get('email', 'string') == Util::getOption('adminemail')
           && fCryptography::checkPasswordHash(fRequest::get('pw', 'string'), Util::getOption('adminpw'))
        ) {
            fAuthorization::setUserToken('logged');
            fURL::redirect(fAuthorization::getRequestedURL(TRUE, '?page=admin'));
        }
        else
            fMessaging::create('wrong-pw', 'login', 'Wrong password or e-mail. Please try again.');

    } catch(fValidationException $e) {
        fMessaging::create('validation', 'login', $e->getMessage());
    }
}