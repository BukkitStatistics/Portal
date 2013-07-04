<?php
global $lang;

$tpl = $this->loadTemplate('player');
$this->addJs('media/js/jquery.bootpag.js');
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
        $blocks = fRecordSet::buildFromSQL(
            'TotalBlock',
            array(
                 '
                SELECT * FROM prefix_total_blocks
                WHERE player_id = %i
                ORDER BY destroyed DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('blocks[most_destroyed]', $blocks->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $blocks = fRecordSet::buildFromSQL(
            'TotalBlock',
            array(
                 '
                SELECT * FROM prefix_total_blocks
                WHERE player_id = %i
                ORDER BY placed DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('blocks[most_placed]', $blocks->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $i = $player->getTotalItems();
    $tpl->set('items[picked]', $i['picked']);
    $tpl->set('items[dropped]', $i['dropped']);
    try {
        $items = fRecordSet::buildFromSQL(
            'TotalItem',
            array(
                 '
                SELECT * FROM prefix_total_items
                WHERE player_id = %i
                ORDER BY picked_up DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('items[most_picked]', $items->getRecord(0));
    } catch(fNoRemainingException $e) {
    }
    try {
        $items = fRecordSet::buildFromSQL(
            'TotalItem',
            array(
                 '
                SELECT * FROM prefix_total_items
                WHERE player_id = %i
                ORDER BY dropped DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('items[most_dropped]', $items->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $p = $player->getTotalPvp();
    $tpl->set('pvp[kills]', $p['kills']);
    $tpl->set('pvp[deaths]', $p['deaths']);
    try {
        $pvp_killer = fRecordSet::buildFromSQL(
            'TotalPvpKill',
            array(
                 '
                SELECT * FROM prefix_total_pvp_kills
                WHERE player_id = %i
                ORDER BY times DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('pvp[most_killed]', $pvp_killer->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $pvp_victim = fRecordSet::buildFromSQL(
            'TotalPvpKill',
            array(
                 '
                SELECT * FROM prefix_total_pvp_kills
                WHERE victim_id = %i
                ORDER BY times DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('pvp[most_killed_by]', $pvp_victim->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    $e = $player->getTotalPve();
    $tpl->set('pve[kills]', $e['kills']);
    $tpl->set('pve[deaths]', $e['deaths']);
    try {
        $pve = fRecordSet::buildFromSQL(
            'TotalPveKill',
            array(
                 '
                SELECT * FROM prefix_total_pve_kills
                WHERE player_id = %i
                AND creature_killed != 0
                ORDER BY creature_killed DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('pve[most_killed]', $pve->getRecord(0));
    } catch(fNoRemainingException $e) {
    }

    try {
        $pve = fRecordSet::buildFromSQL(
            'TotalPveKill',
            array(
                 '
                SELECT * FROM prefix_total_pve_kills
                WHERE player_id = %i
                AND player_killed != 0
                ORDER BY player_killed DESC
                LIMIT 0,1
                 ',
                 $player->getPlayerId()
            )
        );

        $tpl->set('pve[most_killed_by]', $pve->getRecord(0));
    } catch(fNoRemainingException $e) {

    }

    $tpl->set('deaths', $deaths);
    $tpl->set('misc', $misc);

    $this->loadSubModule('mod/player_blocks');
    $this->loadSubModule('mod/player_items');

} catch(fNotFoundException $e) {
    fMessaging::create('no-cache', '{cache}', 1);
}