<?php
$tpl = $this->loadTemplate('admin/general', 'sub');

$tpl->set('langs', array(
                        'en' => 'English',
                        'de' => 'German'
                   ));

/*
 * Store input vales
 */
$tpl->set('language', fRequest::encode('language', 'string', Util::getOption('language')));
$tpl->set('adminemail', fRequest::encode('adminemail', 'string', Util::getOption('adminemail')));

if(fRequest::isPost() && fRequest::check('save')) {
    try {
        $vali = new fValidation();

        $vali->addEmailFields('adminemail')
            ->addRequiredFields('adminemail');

        $vali->validate();

        Util::setOption('adminemail', $tpl->get('adminemail'));
        Util::setOption('language', $tpl->get('language'));

        if(fRequest::get('adminpw') != '')
            Util::setOption('adminpw', fCryptography::hashPassword(fRequest::get('adminpw', 'string')));
    } catch (fValidationException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}