<?php
global $lang;

$tpl = $this->loadTemplate('player');
$lang->load('causes');


try {
    $player = new Player(
        array(
             'name' => fRequest::get('name', 'string')
        )
    );

    if(!$player->exists())
        throw new fNotFoundException();

    $distance = $player->createDistance();
    $blocks = $player->buildTotalBlocks();
    $items = $player->buildTotalItems();
    $pvp_killer = $player->buildTotalPvpKills('player_id');
    $pvp_victim = $player->buildTotalPvpKills('victim_id');
    $pve = $player->buildTotalPveKills();
    $deaths = $player->buildTotalDeaths();
    $misc = $player->createMiscInfoPlayer();
    if(Util::getOption('module.inventory', 1)) {
        $inv = $player->createPlayerInventory();
        $tpl->set('inv', $inv);
    }

    $tpl->set('player', $player);
    $tpl->set('distance', $distance);



    $b = $player->getTotalBlocks();
    $tpl->set('blocks[destroyed]', $b['destroyed']);
    $tpl->set('blocks[placed]', $b['placed']);
    try {
        $tpl->set('blocks[most_destroyed]', $blocks->sort('getDestroyed', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $tpl->set('blocks[most_placed]', $blocks->sort('getPlaced', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $i = $player->getTotalItems();
    $tpl->set('items[picked]', $i['picked']);
    $tpl->set('items[dropped]', $i['dropped']);
    try {
        $tpl->set('items[most_picked]', $items->sort('getPickedUp', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }
    try {
        $tpl->set('items[most_dropped]', $items->sort('getDropped', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $p = $player->getTotalPvp();
    $tpl->set('pvp[kills]', $p['kills']);
    $tpl->set('pvp[deaths]', $p['deaths']);
    try {
        $tpl->set('pvp[most_killed]', $pvp_killer->sort('getTimes', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $tpl->set('pvp[most_killed_by]', $pvp_victim->sort('getTimes', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $e = $player->getTotalPve();
    $tpl->set('pve[kills]', $e['kills']);
    $tpl->set('pve[deaths]', $e['deaths']);
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
    $tpl->set('total_blocks', $blocks->sort('getDestroyed', 'desc')->slice(0, 5));
    $tpl->set('total_items', $items->sort('getPickedUp', 'desc')->slice(0, 5));
    $tpl->set('misc', $misc);

} catch(fNotFoundException $e) {
    fMessaging::create('no-cache', '{cache}', 1);
}