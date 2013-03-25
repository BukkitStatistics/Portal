<?php
$tpl_ponline = Util::newTpl($this, 'mod/players_online', 'players_online');

switch(fRequest::get('order_type', 'int')) {
    case 1:
        $type = 'name';
        break;
    default:
    case 2:
        $type = 'login_time';
        break;
}

$players = fRecordSet::build(
    'Player',
    array(
         'online=' => true
    ),
    array(
         $type => fRequest::get('order_sort', 'string', 'desc')
    ),
    3,
    1
);

$tpl_ponline->set('online_players', $players);

if(fRequest::isAjax()) {
    $tpl_ponline->place();
    die();
}