<?php
$tpl_players = Util::newTpl($this, 'mod/players', 'total_players');

switch(fRequest::get('order_by', 'int')) {
    default:
    case 1:
        $type = 'name';
        break;
    case 2:
        $type = 'login_time';
        break;
    case 3:
        $type = 'first_login';
        break;
    case 4:
        $type = 'playtime';
        break;
}

$players = fRecordSet::build(
    'Player',
    array(),
    array(
         $type => fRequest::get('order_sort', 'string', 'asc')
    ),
    10,
    fRequest::get('p', 'int', 1)
);

$tpl_players->set('players', $players);

if(fRequest::isAjax()) {
    $tpl_players->place();
    die();
}