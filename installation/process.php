<?php
if(fSession::get('maxStep') < 6)
    fURL::redirect('?step=converter');

$tpl = Util::newTpl($this, 'process');

$type = fRequest::get('type');
if(is_null($type)) {
    $tpl->set('perc', 0);
    $tpl->set('next_step', '');
    $tpl->set('current', fText::compose('players'));
    // add <noscript></noscript> for later ajax use :)
    $this->add('header_additions',
               '<meta http-equiv="REFRESH" content="0;url=?step=process&type=players">');
}
else {
    $perc = 0;
    $oldDb = new fDatabase('mysql', fSession::get('convertDB[database]'),
                           fSession::get('convertDB[user]'),
                           fSession::get('convertDB[pw]'),
                           fSession::get('convertDB[host]'));

    $conv = new Converter($oldDb, fORMDatabase::retrieve(), fSession::get('converter[last_start]'));
    $conv->getOldStats();

    $perc = $conv->process($type);
    $tpl->set('perc', $perc);
    $tpl->set('next_step', '');
    $tpl->set('current', fText::compose($type));

    if($perc >= 100) {
        $convert = fSession::get('convert');

        $tpl->set('next_step', '?step=process&type=' . key($convert) . '');

        $convert = array_splice($convert, 1);
        fSession::set('convert', $convert);
        fSession::set('converter[last_start]', 0);
    }
    else {
        $this->add('header_additions',
                   '<meta http-equiv="REFRESH" content="1;url=?step=process&type=' . $type . '">');
    }
}
