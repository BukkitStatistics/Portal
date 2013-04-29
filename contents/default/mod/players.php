<?php
$tpl_players = Util::newTpl($this, 'mod/players', 'total_players');

$sort = fRequest::get('order_sort', 'string', 'asc');

switch(fRequest::get('order_by', 'int')) {
    default:
    case 1:
        $type = 'name';
        $tpl_players->set('sort[1]', $sort);
        break;
    case 2:
        $type = 'login_time';
        $tpl_players->set('sort[2]', $sort);
        break;
    case 3:
        $type = 'first_login';
        $tpl_players->set('sort[3]', $sort);
        break;
    case 4:
        $type = 'playtime';
        $tpl_players->set('sort[4]', $sort);
        break;
}

$players = fRecordSet::build(
    'Player',
    array(),
    array(
         $type => $sort
    ),
    10,
    fRequest::get('p', 'int', 1)
);

$tpl_players->set('players', $players);

if(fRequest::isAjax()) {
    $tpl_players->place();
    die();
}