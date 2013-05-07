<?php
if(fSession::get('maxStep') < 4)
    fURL::redirect('?step=three');

$tpl = $this->loadTemplate('four', 'tpl');

fSession::delete('converterStats');
fSession::delete('convertDB');

$tpl->set('title', fSession::get('settings[title]'));
$tpl->set('adminemail', fSession::get('settings[adminemail]'));
$tpl->set('timezone', fSession::get('settings[timezone]'));
$tpl->set('time_format', fText::compose('%s hour format', fSession::get('settings[time_format]')));
$tpl->set('ping', fSession::get('settings[ping]'));
$tpl->set('welcome_msg', fSession::get('settings[welcome_msg]'));
$tpl->set('welcome_first_msg', fSession::get('settings[welcome_first_msg]'));

if(!fMessaging::check('*') && fRequest::isPost() && fRequest::get('convert_submit')) {

    if(fRequest::get('old_data', 'boolean')) {
        fSession::set('maxStep', 5);
        fURL::redirect('?step=converter');
    }
    else {
        fSession::set('maxStep', 7);
        fURL::redirect('?step=five');
    }

} else {
    // checking cache dir
    try {
        $cache_dir = new fDirectory(__ROOT__ . 'cache/files');
        $tpl->set('cache_dir', $cache_dir->getPath(true));
        if($cache_dir->isWritable())
            $tpl->set('cache_write', true);
        else
            $tpl->set('cache_write', false);
    } catch(fValidationException $e) {
        fMessaging::create('errors', $e->getMessage());
    }
}