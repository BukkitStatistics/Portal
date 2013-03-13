<?php
$tpl_players = Util::newTpl($this, 'mod/players', 'total_players');

switch(fRequest::get('order_by', 'int')) {
    default:
    case 1:
        $type = 'name';
        break;
    case 2:
        $type = Util::getPrefix() . 'detailed_log_players.time';
        break;
    case 3:
        $type = 'login_time';
        break;
}

$players = fRecordSet::build(
    'Player',
    array(),
    array(
         $type => fRequest::get('order_sort', 'string', 'asc')
    ),
    10,
    1
);

$tpl_players->set('players', $players);

if(fRequest::isAjax()) {
    $tpl_players->place();
    die();
}