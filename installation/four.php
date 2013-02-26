<?php
if(fSession::get('maxStep') < 4)
    fURL::redirect('?step=three');

$tpl = Util::newTpl($this, 'four');

fSession::delete('converterStats');

if(!fMessaging::check('*') && fRequest::isPost() && fRequest::get('convert_submit')) {
    fSession::set('maxStep', 5);
    if(fRequest::get('old_data', 'boolean'))
        fURL::redirect('?step=converter');
    else fURL::redirect('?step=five');
} else {
    // checking cache dir
    try {
        $cache_dir = new fDirectory(__ROOT__ . 'cache');
        if($cache_dir->isWritable())
            $tpl->set('cache_dir', fText::compose('%s is writable', $cache_dir->getPath(true)));
        else $tpl->set('cache_dir', fText::compose('%s is not writable. Check the permissions'));
    } catch(fValidationException $e) {
        fMessaging::create('errors', $e->getMessage());
    }
}