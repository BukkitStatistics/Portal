<?php
$tpl = Util::newTpl($this, 'overview');

$players = fRecordSet::build(
    'Player'
);

// player stats in dashboard
$num = new fNumber($players->count());
$player_stats['tracked'] = $num->format();
$player_stats['died'] = Player::countAllDeaths()->format();
$player_stats['killed'] = Player::countAllKills()->format();

$players = $players->filter(array('getOnline=' => true));
$player_stats['online'] = $players->count();


$tpl->set('players', $player_stats);

// server stats in dashboard
$server = new ServerStatistic();

$server_stats['startup'] = $server->getStartup();
$server_stats['shutdown'] = $server->getShutdown();
$server_stats['cur_uptime'] = $server->getCurrentUptime();
$server_stats['total_uptime'] = $server->getTotalUptime();
$server_stats['total_logins'] = Player::countAllLogins()->format();
$server_stats['max_players'] = $server->getMaxPlayersOnline();

$tpl->set('serverstats', $server_stats);

// block stats
$block_stats['destroyed'] = Material::countAllDestroyedBlocks();
$block_stats['placed'] = Material::countAllPlacedBlocks();
$block_stats['most_placed'] = Material::getMostPlacedBlock();
$block_stats['most_destroyed'] = Material::getMostDestroyedBlock();