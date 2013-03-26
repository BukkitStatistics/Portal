<?php
fMessaging::create('no-cache', '{cache}', true);
fAuthorization::requireLoggedIn();

$tpl = Util::newTpl($this, 'admin');

if(fRequest::get('sub', 'string')) {
    $this->inject('admin/' . fRequest::get('sub', 'string') . '.php');
    $tpl->set('sub', $this->get('sub'));
}

if(fRequest::isPost() && fRequest::get('logout')) {
    fAuthorization::destroyUserInfo();
    fURL::redirect('./');
}