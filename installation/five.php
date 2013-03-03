<?php
if(fSession::get('maxStep') < 7)
    fURL::redirect('?step=converter');

$tpl = Util::newTpl($this, 'five');

if(fRequest::isPost() && fRequest::get('finish')) {
    try {
        $installDir = new fDirectory('installation');
        $installFile = new fFile('install.php');

        //$installDir->delete();
        //$installFile->delete();

        fURL::redirect('.');
    } catch(fValidationException $e) {
        fMessaging::create('dir/file', 'install/five', $e->getMessage());
    } catch(fEnvironmentException $e) {
        fMessaging::create('delete', 'install/five', $e->getMessage());
    }
}