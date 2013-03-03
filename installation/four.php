<?php
if(fSession::get('maxStep') < 4)
    fURL::redirect('?step=three');

$tpl = Util::newTpl($this, 'four');

fSession::delete('converterStats');
fSession::delete('convertDB');

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
        $cache_dir = new fDirectory(__ROOT__ . 'cache');
        if($cache_dir->isWritable())
            $tpl->set('cache_dir', fText::compose('%s is writable', $cache_dir->getPath(true)));
        else $tpl->set('cache_dir', fText::compose('%s is not writable. Check the permissions',
                                                   $cache_dir->getPath(true)));
    } catch(fValidationException $e) {
        fMessaging::create('errors', $e->getMessage());
    }
}