<?php
fMessaging::create('no-cache', '{cache}', true);
fAuthorization::requireLoggedIn();

$tpl = $this->loadTemplate('admin');
$sub = fRequest::get('sub', 'string');
if($sub) {
    $tpl->set($sub, 'active');
    $this->loadSubModule('admin/' . $sub);
}
else {
    $this->loadTemplate('admin/main', 'sub');
    $tpl->set('main', true);
}
if(fRequest::isPost() && fRequest::get('logout')) {
    fAuthorization::destroyUserInfo();
    fURL::redirect('./');
}