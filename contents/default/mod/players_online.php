<?php
$tpl_ponline = Util::newTpl($this, 'mod/players_online', 'players_online');

$players = fRecordSet::build(
    'Player',
    array(
         'online=' => true
    ),
    array(
         'login_time' => 'desc'
    )
);

$tpl_ponline->set('online_players', $players);