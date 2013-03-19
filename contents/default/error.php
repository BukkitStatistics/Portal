<?php
$tpl = Util::newTpl($this, 'error');
$this->set('title', 'Error occurred.');

$type = fRequest::get('type', 'string');

if(fMessaging::check('error', '{errors}'))
    $type = 'error';
elseif(fMessaging::check('critical', '{errors}'))
    $type = 'critical';


$tpl->set('type', $type);

if($type != '' && $type != '404') {
    $e = fMessaging::retrieve($type, '{errors}');

    $tpl->set('e_message', $e->getMessage());
    $tpl->set('e_name', get_class($e));
    $tpl->set('e_backtrace', $e->getTraceAsString());
    $tpl->set('e_file', $e->getFile());
    $tpl->set('e_line', $e->getLine());
}