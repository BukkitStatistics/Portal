<?php
$tpl = Util::newTpl($this, 'player');
$this->add('js', 'media/js/jquery.bootpag.js');
$this->get('lang')->load('causes');


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

    // death log
    $this->inject('mod/death_log.php');
    $tpl->set('death_log', $this->get('death_log'));

    $tpl->set('player', $player);
    $tpl->set('distance', $distance);

    $tpl->set('blocks[destroyed]', $player->getTotalBlocks()['destroyed']);
    $tpl->set('blocks[placed]', $player->getTotalBlocks()['placed']);
    try {
        $tpl->set('blocks[most_destroyed]', $blocks->sort('getDestroyed', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $tpl->set('blocks[most_placed]', $blocks->sort('getPlaced', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('items[picked]', $player->getTotalItems()['picked']);
    $tpl->set('items[dropped]', $player->getTotalItems()['dropped']);
    try {
        $tpl->set('items[most_picked]', $items->sort('getPickedUp', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }
    try {
        $tpl->set('items[most_dropped]', $items->sort('getDropped', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('pvp[kills]', $player->getTotalPvp()['kills']);
    $tpl->set('pvp[deaths]', $player->getTotalPvp()['deaths']);
    try {
        $tpl->set('pvp[most_killed]', $pvp_killer->sort('getTimes', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $tpl->set('pvp[most_killed_by]', $pvp_victim->sort('getTimes', 'desc')->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $tpl->set('pve[kills]', $player->getTotalPve()['kills']);
    $tpl->set('pve[deaths]', $player->getTotalPve()['deaths']);
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

} catch (fNotFoundException $e) {
    fMessaging::create('no-cache', '{cache}', 1);
}