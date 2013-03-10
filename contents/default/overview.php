<?php
$tpl = Util::newTpl($this, 'overview');
$this->add('js', fFilesystem::translateToWebPath(__ROOT__ . 'media/js/jquery.tablesorter.min.js'));
$this->add('css', fFilesystem::translateToWebPath(__ROOT__ . 'media/css/tablesorter.css'));

$players = fRecordSet::build(
    'Player'
);

$tpl->set('all_players', $players);

// player stats in dashboard
$num = new fNumber($players->count());
$player_stats['tracked'] = $num->format();
$player_stats['died'] = Player::countAllDeaths()->format();
$player_stats['killed'] = Player::countAllKillsOfType()->format();

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
$distance_stats['total'] = Player::getDistanceOfType('total')->format();
$distance_stats['foot'] = Player::getDistanceOfType('foot')->format();
$distance_stats['minecart'] = Player::getDistanceOfType('minecart')->format();
$distance_stats['boat'] = Player::getDistanceOfType('boat')->format();

$tpl->set('distance', $distance_stats);

// block stats
$block_stats['destroyed'] = TotalBlock::countAllOfType('destroyed')->format();
$block_stats['placed'] = TotalBlock::countAllOfType('placed')->format();
$block_stats['most_placed'] = TotalBlock::getMostOfType('placed');
$block_stats['most_destroyed'] = TotalBlock::getMostOfType('destroyed');

$tpl->set('blocks', $block_stats);

// player stats
$tpl->set('online_players', $players);

// deaths stats
$death_stats['total'] = $player_stats['killed'];
$death_stats['pve'] = Player::countAllKillsOfType('pve')->format();
$death_stats['pvp'] = Player::countAllKillsOfType('pvp')->format();
$death_stats['evp'] = Player::countAllKillsOfType('evp')->format();
$death_stats['deaths'] = $player_stats['died'];
$death_stats['most_dangerous'] = Entity::getMostDangerous();
$death_stats['top_killer'] = Player::getMostDangerous();
$death_stats['top_weapon'] = Material::getMostDangerous();
$death_stats['most_killed_mob'] = Entity::getMostKilled();
$death_stats['most_killed_player'] = Player::getMostKilled();

$tpl->set('deaths', $death_stats);

// items stats
$item_stats['dropped'] = TotalItem::countAllOfType('dropped')->format();
$item_stats['picked'] = TotalItem::countAllOfType('picked_up')->format();
$item_stats['most_dropped'] = TotalItem::getMostOfType('dropped');
$item_stats['most_picked'] = TotalItem::getMostOfType('picked_up');

$tpl->set('items', $item_stats);

// blocks
$blocks = fRecordSet::build(
    'Material'
)->filter('{record}::hasTotalBlocks');

$tpl->set('block_list', $blocks);

// items
$items = fRecordSet::build(
    'Material'
)->filter('{record}::hasTotalItems');

$tpl->set('item_list', $items);