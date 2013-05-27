<?php
fMessaging::create('no-cache', '{cache}', true);
$tpl = $this->loadTemplate('reset');

if(fRequest::isPost() && fRequest::get('send_pw')) {
    /*
     * Store input values
     */
    $tpl->set('email', fRequest::get('email', 'string'));

    try {
        $vali = new fValidation();

        $vali->addRequiredFields('email')
        ->addEmailFields('email')
        ->validate();

        if($tpl->get('email') != Util::getOption('adminemail'))
            throw new fValidationException('Wrong E-Mail. Please try again.');

        $new_pw = fCryptography::randomString(8);

        $mail = new fEmail();
        $mail->setFromEmail('no-reply@' . $_SERVER['SERVER_NAME'] . '.com', Util::getOption('portal_title'));
        $mail->addRecipient(Util::getOption('adminemail'));
        $mail->setSubject('Statistics password reset for ' . Util::getOption('portal_title'));
        $mail->setBody('
            You requested an password reset for your Statistics portal (' . Util::getOption('portal_title') . ').

            Your new password is: ' . $new_pw . '
            Please change it as soon as possible!
        ', true);

        $mail->send();

        Util::setOption('adminpw', fCryptography::hashPassword($new_pw));
        fURL::redirect('?page=login');
    } catch(fValidationException $e) {
        fMessaging::create('mail', 'reset', $e->getMessage());
    } catch(fConnectivityException $e) {
        fMessaging::create('send', 'reset', $e->getMessage());
    }
}