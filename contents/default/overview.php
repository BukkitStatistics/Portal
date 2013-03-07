<?php
$tpl = Util::newTpl($this, 'overview');

$all_players = $players = fRecordSet::build(
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
$server_stats['max_players'] = $server->getMaxPlayersOnline(true);

$tpl->set('serverstats', $server_stats);

// distance
$distance_stats['total'] = 0;
$distance_stats['foot'] = 0;
$distance_stats['minecart'] = 0;
$distance_stats['boat'] = 0;
$distance_stats['pig'] = 0;

$tpl->set('distance', $distance_stats);

// block stats
$block_stats['destroyed'] = Material::countAllDestroyedBlocks()->format();
$block_stats['placed'] = Material::countAllPlacedBlocks()->format();
$block_stats['most_placed'] = Material::getMostPlacedBlock();
$block_stats['most_destroyed'] = Material::getMostDestroyedBlock();

$tpl->set('blocks', $block_stats);

// player stats
$tpl->set('online_players', $players);