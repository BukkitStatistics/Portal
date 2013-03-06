<?php
$tpl = Util::newTpl($this, 'overview');

$players = fRecordSet::build(
    'Player'
);

// player stats in dashboard
$player_stats['tracked'] = $players->count();
$player_stats['died'] = Player::countAllDeaths();
$player_stats['killed'] = Player::countAllKills();

$players = $players->filter(array('getOnline=' => true));
$player_stats['online'] = $players->count();


$tpl->set('players', $player_stats);

// server stats in dashboard
$server = new ServerStatistic();

$server_stats['startup'] = $server->getStartup();
$server_stats['shutdown'] = $server->getShutdown();
$server_stats['cur_uptime'] = $server->getCurrentUptime();
$server_stats['total_uptime'] = $server->getTotalUptime();
$server_stats['total_logins'] = Player::countAllLogins();
$server_stats['max_players'] = $server->getMaxPlayersOnline();

$tpl->set('serverstats', $server_stats);