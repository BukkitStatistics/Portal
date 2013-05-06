<?php
fMessaging::create('no-cache', '{cache}', true);
fAuthorization::requireLoggedIn();

$tpl = $this->loadTemplate('admin', 'tpl');

if(fRequest::get('sub', 'string'))
    $this->loadSubModule('admin/' . fRequest::get('sub', 'string'));
if(fRequest::isPost() && fRequest::get('logout')) {
    fAuthorization::destroyUserInfo();
    fURL::redirect('./');
}