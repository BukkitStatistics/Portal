<?php
$tpl = $this->loadTemplate('one', 'tpl');

// resets the previous session if some one had to start from the beginning
if(!fRequest::isPost())
    fSession::reset();

// workaround because the session gets destroyed
fMessaging::create('no-cache', '{cache}', true);
/*
 * Gets the data from step one
 */
if(fRequest::isPost() && fRequest::get('lang_submit')) {
    fSession::set('lang', fRequest::get('lang'));
    fSession::set('maxStep', 2);
    fURL::redirect('?step=two');
}
else
    fSession::set('maxStep', 1);