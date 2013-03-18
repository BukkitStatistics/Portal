<?php
$tpl = Util::newTpl($this, 'player');

try {
    $player = new Player(fRequest::get('id', 'int'));
    $distance = $player->createDistance();
    $blocks = $player->buildTotalBlocks();
    $items = $player->buildTotalItems();
    $pvp_killer = $player->buildTotalPvpKills('player_id');
    $pvp_victim = $player->buildTotalPvpKills('victim_id');
    $pve = $player->buildTotalPveKills();
    $deaths = $player->buildTotalDeaths();
    $misc = $player->createMiscInfoPlayer();

    $destroyed = new fNumber(0);
    $placed = new fNumber(0);
    foreach($blocks as $block) {
        $destroyed = $destroyed->add($block->getDestroyed());
        $placed = $placed->add($block->getPlaced());
    }

    $picked = new fNumber(0);
    $dropped = new fNumber(0);
    foreach($items as $item) {
        $picked = $picked->add($item->getPickedUp());
        $dropped = $dropped->add($item->getDropped());
    }

    $pvp_kills = new fNumber(0);
    foreach($pvp_killer as $pvp_kill)
        $pvp_kills = $pvp_kills->add($pvp_kill->getTimes());

    $pvp_deaths = new fNumber(0);
    foreach($pvp_victim as $victim)
        $pvp_deaths = $pvp_deaths->add($victim->getTimes());

    $pve_kills = new fNumber(0);
    $pve_deaths = new fNumber(0);
    foreach($pve as $pve_kill) {
        $pve_kills = $pve_kills->add($pve_kill->getCreatureKilled());
        $pve_deaths = $pve_deaths->add($pve_kill->getPlayerKilled());
    }

    $tpl->set('player', $player);
    $tpl->set('distance', $distance);

    $tpl->set('blocks[destroyed]', $destroyed);
    $tpl->set('blocks[placed]', $placed);
    try {
        $tpl->set('blocks[most_destroyed]', $blocks->sort('getDestroyed', 'desc')->getRecord(0));
        $tpl->set('blocks[most_placed]', $blocks->sort('getPlaced', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('items[picked]', $picked);
    $tpl->set('items[dropped]', $dropped);
    try {
        $tpl->set('items[most_picked]', $items->sort('getPickedUp', 'desc')->getRecord(0));
        $tpl->set('items[most_dropped]', $items->sort('getDropped', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('pvp[kills]', $pvp_kills);
    $tpl->set('pvp[deaths]', $pvp_deaths);
    try {
        $tpl->set('pvp[most_killed]', $pvp_killer->sort('getTimes', 'desc')->getRecord(0));
        $tpl->set('pvp[most_killed_by]', $pvp_victim->sort('getTimes', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('pve[kills]', $pve_kills);
    $tpl->set('pve[deaths]', $pve_deaths);
    try {
        $tpl->set('pve[most_killed]', $pve->filter(array(
                                                        'getCreatureKilled!' => 0
                                                   ))
            ->sort('getCreatureKilled', 'desc')
            ->getRecord(0));

        $tpl->set('pve[most_killed_by]', $pve->filter(array(
                                                           'getPlayerKilled!' => 0
                                                      ))
            ->sort('getPlayerKilled', 'desc')
            ->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('deaths', $deaths);
    $tpl->set('misc', $misc);

} catch (fNotFoundException $e) {
    fMessaging::create('no-cache', '{cache}', 1);
}