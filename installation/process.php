<?php
if(fSession::get('maxStep') < 6)
    fURL::redirect('?step=converter');

$tpl = $this->loadTemplate('process', 'tpl');
$tpl->set('title', $this->getDesignTpl()->get('title'));

function sendJson($perc, $next, $tpl) {
    fJSON::sendHeader();
    echo fJSON::encode(array(
                            'perc'    => $perc,
                            'next'    => $next,
                            'current' => $tpl->get('current')
                       ));

    die();
}

$type = fRequest::get('type');
if(is_null($type)) {
    $tpl->set('perc', 0);
    $tpl->set('next_step', '');
    $tpl->set('current', fText::compose('players'));
    $tpl->set('type', 'players');
    $this->addHeaderAddition('<noscript><meta http-equiv="REFRESH" content="0;url=?step=process&type=players"></noscript>');
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
    $tpl->set('type', $type);
    $tpl->set('current', fText::compose($type));

    if($perc >= 100) {
        $convert = fSession::get('convert');
        $next = '';

        if(key($convert) != '') {
            $next = key($convert);
            $tpl->set('next_step', '?step=process&type=' . $next);
            $tpl->set('current', fText::compose($next));
            $convert = array_splice($convert, 1);
            fSession::set('convert', $convert);
            fSession::set('converter[last_start]', 0);
        }
        else {
            $tpl->set('next_step', '?step=five');
            fSession::set('maxStep', 7);
            fSession::delete('convert');
            fSession::delete('converter');
        }

        if(fRequest::isAjax()) {
            sendJson($perc, $next, $tpl);
        }
    }
    else {

        if(fRequest::isAjax()) {
            sendJson($perc, $type, $tpl);
        }

        $this->addHeaderAddition('<noscript><meta http-equiv="REFRESH" content="1;url=?step=process&type=' . $type . '"></noscript>');
    }
}
