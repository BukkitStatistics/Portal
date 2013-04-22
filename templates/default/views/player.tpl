<?php if(!is_null($this->get('player'))): ?>
    <div class="row-fluid">

        <div class="well well-small span6
        <?php if($this->get('misc')->getIsBanned()): ?>
        alert-danger
        <?php endif; ?>"
             style="position: relative;">
            <h1 style="position: relative">
                <?php echo $this->get('player')->getPlayerHead(64, 'img-polaroid'); ?>
                <?php echo $this->get('player')->encodeName(); ?>
                <?php if($this->get('player')->getOnline()): ?>
                    <span class='label label-success player-status'>In-Game</span>
                <?php else: ?>
                    <span class='label label-important player-status'>Offline</span>
                <?php endif; ?>
                <?php if($this->get('misc')->getIsOp()): ?>
                    <span class="label label-info player-op">OP</span>
                <?php endif; ?>
                <?php if($this->get('misc')->getIsBanned()): ?>
                    <span class="label label-important player-banned">
                        <strong>banned</strong>
                    </span>
                <?php endif; ?>
            </h1>

            <div class="bar-container">
                <div class="xpbar-cur">
                    <strong><?php echo $this->get('misc')->getExpLevel(); ?></strong>
                </div>

                <div class="row-fluid" id="playerhead-bars">
                    <div class="span6 heart-bars">
                        <?php echo $this->get('misc')->getHealthBar(); ?>
                    </div>

                    <div class="span6 hunger-bars">
                        <?php echo $this->get('misc')->getFoodBar(); ?>
                    </div>
                </div>

                <div class="force-center xpbar-container">
                    <?php echo $this->get('misc')->getXPBar(); ?>
                </div>
            </div>

            <div class="player-effects">
                <?php
                if($this->get('inv'))
                    $this->get('inv')->printEffects();
                ?>
            </div>
        </div>
        <div class="span6">
            <?php if($this->get('inv')): ?>
                <div class="player-inv pull-right">
                    <div class="player-inv-row clearfix">
                        <?php $this->get('inv')->printRowOne(); ?>
                    </div>
                    <div class="player-inv-row clearfix">
                        <?php $this->get('inv')->printRowTwo(); ?>
                    </div>
                    <div class="player-inv-row clearfix">
                        <?php $this->get('inv')->printRowThree(); ?>
                    </div>
                    <div class="player-inv-hotbar clearfix">
                        <?php $this->get('inv')->printHotbar(); ?>
                    </div>
                </div>
                <div class="player-armor pull-right">
                    <?php $this->get('inv')->printArmor(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span3 center">
            <?php
            if($this->get('pvp[most_killed_by]'))
                $player = $this->get('pvp[most_killed_by]')->createPlayer('player_id');
            else {
                $player = new Player();
                $player->setName('none');
            }
            ?>
            <?php echo $player->getPlayerHead(64, 'img-polaroid'); ?>
            <h4 class="well well-small center">
                <?php if($player->getName() != 'none'): ?>
                    <a href="?page=player&name=<?php echo $player->getName(); ?>"><?php echo $player->getName(); ?></a>
                <?php else: ?>
                    <?php echo $player->getName(); ?>
                <?php endif; ?>
                <br/>
                <small>Arch Nemesis</small>
            </h4>
        </div>
        <div class="span3 center">
            <?php
            if($this->get('pvp[most_killed]'))
                $player = $this->get('pvp[most_killed]')->createPlayer('victim_id');
            else {
                $player = new Player();
                $player->setName('none');
            }
            ?>
            <?php echo $player->getPlayerHead(64, 'img-polaroid'); ?>
            <h4 class="well well-small center">
                <?php if($player->getName() != 'none'): ?>
                    <a href="?page=player&name=<?php echo $player->getName(); ?>"><?php echo $player->getName(); ?></a>
                <?php else: ?>
                    <?php echo $player->getName(); ?>
                <?php endif; ?>
                <br>
                <small>Most killed</small>
            </h4>
        </div>
        <div class="span3 center">
            <?php
            if($this->get('blocks[most_destroyed]'))
                $block = $this->get('blocks[most_destroyed]')->createMaterial();
            else
                $block = new Material('-1:0');
            ?>
            <?php echo $block->getImage(64, 'img-polaroid'); ?>
            <h4 class="well well-small center">
                <?php echo $block->getName(); ?>
                <br>
                <small>Most broken</small>
            </h4>
        </div>
        <div class="span3 center">
            <?php
            if($this->get('blocks[most_placed]'))
                $block = $this->get('blocks[most_placed]')->createMaterial();
            else
                $block = new Material('-1:0');
            ?>
            <?php echo $block->getImage(64, 'img-polaroid'); ?>
            <h4 class="well well-small center">
                <?php echo $block->getName(); ?>
                <br>
                <small>Most placed</small>
            </h4>
        </div>
    </div>

    <h2>General Statistics</h2>

    <div class="row-fluid col-wrap-320">

        <div class="span4 well well-small col">
            <h3>Blocks</h3>

            <p>
                <strong>Total Placed:</strong>
                <?php echo $this->get('blocks[placed]')->format(); ?> Blocks
            </p>

            <p>
                <strong>Most Placed:</strong>
                <?php
                if($this->get('blocks[most_placed]')):
                    $block = $this->get('blocks[most_placed]')->createMaterial();
                    echo $block->getImage(32, null ,true);
                    ?>
                    <?php
                    echo $this->get('blocks[most_placed]')->getPlaced()->format();
                else:
                    ?>
                    <em>none</em>
                <?php endif; ?>
            </p>

            <p>
                <strong>Total Destroyed:</strong>
                <?php echo $this->get('blocks[destroyed]')->format(); ?> Blocks
            </p>

            <p>
                <strong>Most Destroyed:</strong>
                <?php
                if($this->get('blocks[most_destroyed]')):
                    $block = $this->get('blocks[most_destroyed]')->createMaterial();
                    echo $block->getImage(32, null, true);
                    ?>

                    <?php
                    echo $this->get('blocks[most_destroyed]')->getDestroyed()->format();
                else:
                    ?>
                    <em>none</em>
                <?php endif; ?>
            </p>
        </div>

        <div class="span4 well well-small col">
            <h3>Items</h3>

            <p>
                <strong>Total Picked Up:</strong>
                <?php echo $this->get('items[picked]')->format(); ?> Items
            </p>

            <p>
                <strong>Most Picked Up:</strong>
                <?php
                if($this->get('items[most_picked]')):
                    $item = $this->get('items[most_picked]')->createMaterial();
                    echo $item->getImage(32, null, true);
                    ?>

                    <?php
                    echo $this->get('items[most_picked]')->getPickedUp()->format();
                else:
                    ?>
                    <em>none</em>
                <?php endif; ?>
            </p>

            <p>
                <strong>Total Dropped:</strong>
                <?php echo $this->get('items[dropped]')->format(); ?> Items
            </p>

            <p>
                <strong>Most Dropped:</strong>
                <?php
                if($this->get('items[most_dropped]')):
                    $item = $this->get('items[most_dropped]')->createMaterial();
                    echo $item->getImage(32, null, true);
                    ?>

                    <?php
                    echo $this->get('items[most_dropped]')->getDropped()->format();
                else:
                    ?>
                    <em>none</em>
                <?php endif; ?>
            </p>
        </div>

        <div class="span4 well well-small col">
            <h3>Distances</h3>

            <p>
                <strong>Travelled:</strong>
                <?php echo $this->get('distance')->prepareTotal(); ?> meters
            </p>

            <p>
                <strong>Walked:</strong>
                <?php echo $this->get('distance')->prepareFoot(); ?> meters
            </p>

            <p>
                <strong>Minecarted:</strong>
                <?php echo $this->get('distance')->prepareMinecart(); ?> meters
            </p>

            <p>
                <strong>Boated:</strong>
                <?php echo $this->get('distance')->prepareBoat(); ?> meters
            </p>

            <p>
                <strong>Piggybacked:</strong>
                <?php echo $this->get('distance')->preparePig(); ?> meters
            </p>

            <p>
                <strong>Swum:</strong>
                <?php echo $this->get('distance')->prepareSwim(); ?> meters
            </p>

            <p>
                <strong>Flight:</strong>
                <?php echo $this->get('distance')->prepareFlight(); ?> meters
            </p>
        </div>

    </div>

    <div class="row-fluid col-wrap-220">

        <div class="span8 well well-small col">
            <h3>Miscellaneous</h3>
            <table class="table table-condensed no-border">
                <tr>
                    <td>
                        <strong>Total XP:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareExpTotal(); ?>
                    </td>
                    <td>
                        <strong>Times kicked:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareTimesKicked(); ?>
                    </td>
                    <td>
                        <strong>Eggs thrown:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareEggsThrown(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Food eaten:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareFoodEaten(); ?>
                    </td>
                    <td>
                        <strong>Arrows shot:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareArrowsShot(); ?>
                    </td>
                    <td>
                        <strong>Damage taken:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareDamageTaken(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Words said:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareWordsSaid(); ?>
                    </td>
                    <td>
                        <strong>Commands sent:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareCommandsSent(); ?>
                    </td>
                    <td>
                        <strong>Beds entered:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareBedsEntered(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Portals entered:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->preparePortalsEntered(); ?>
                    </td>
                    <td>
                        <strong>Fish caught:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareFishCaught(); ?>
                    </td>
                    <td>
                        <strong>Times jumped:</strong>
                    </td>
                    <td>
                        <?php echo $this->get('misc')->prepareTimesJumped(); ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="span4 well well-small col">
            <h3>Login statistics</h3>

            <p>
                <strong>Joined on:</strong>
                <?php
                $time = new fTimestamp($this->get('player')->getFirstLogin());
                echo $time->format('std');
                ?>
            </p>

            <p>
                <strong>Last seen:</strong>
                <?php
                if(!is_null($this->get('player')->getLoginTime())):
                    $time = new fTimestamp($this->get('player')->getLoginTime());
                    echo $time->format('std');
                    ?>
                <?php else: ?>
                    <em>never</em>
                <?php endif; ?>
            </p>

            <p>
                <strong>Playtime:</strong>
                <?php
                echo Util::formatSeconds(new fTimestamp($this->get('player')->getPlaytime()));
                ?>
            </p>
        </div>

    </div>

    <div class="row-fluid">

        <div class="span4 well well-small">
            <h3>PvP</h3>

            <p>
                <strong>Total Kills:</strong>
                <?php echo $this->get('pvp[kills]')->format(); ?>
            </p>

            <p>
                <strong>Total Deaths:</strong>
                <?php echo $this->get('pvp[deaths]')->format(); ?>
            </p>

            <p>
                <strong>Current kill streak:</strong>
                <?php echo $this->get('misc')->prepareKillStreak(); ?>
            </p>

            <p>
                <strong>Best kill streak:</strong>
                <?php echo $this->get('misc')->prepareMaxKillStreak(); ?>
            </p>
            <?php if($this->get('pvp[most_killed]')): ?>
                <br/>
                <h4>Most killed:</h4>
                <p>
                    <?php $victim = $this->get('pvp[most_killed]')->createPlayer('victim_id'); ?>
                    <a href="?page=player&name=<?php echo $victim->getName(); ?>">
                        <?php
                        echo $victim->getPlayerHead();
                        ?>
                        <?php echo $victim->encodeName(); ?>
                    </a>
                </p>
                <p>
                    <strong>Kills:</strong>
                    <?php echo $this->get('pvp[most_killed]')->getTimes()->format(); ?>
                </p>
                <p>
                    <strong>Used weapon:</strong>
                    <?php
                    $weapon = $this->get('pvp[most_killed]')->createMaterial();
                    echo $weapon->getImage();
                    ?>
                    <?php echo $weapon->encodeName(); ?>
                </p>
            <?php endif; ?>
            <?php if($this->get('pvp[most_killed_by]')): ?>
                <br/>
                <h4>Most killed by:</h4>

                <p>
                    <?php $killer = $this->get('pvp[most_killed_by]')->createPlayer('player_id'); ?>
                    <a href="?page=player&name=<?php echo $killer->getName(); ?>">
                        <?php
                        echo $killer->getPlayerHead();
                        ?>
                        <?php echo $killer->encodeName(); ?>
                    </a>
                </p>

                <p>
                    <strong>Kills:</strong>
                    <?php echo $this->get('pvp[most_killed_by]')->getTimes()->format(); ?>
                </p>
                <p>
                    <strong>Used weapon:</strong>
                    <?php
                    $weapon = $this->get('pvp[most_killed_by]')->createMaterial();
                    echo $weapon->getImage();
                    ?>
                    <?php echo $weapon->encodeName(); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="span4 well well-small">
            <h3>PvE</h3>

            <p>
                <strong>Total Kills:</strong>
                <?php echo $this->get('pve[kills]')->format(); ?>
            </p>

            <p><strong>Total Deaths:</strong>
                <?php echo $this->get('pve[deaths]')->format(); ?>
            </p>
            <?php if($this->get('pve[most_killed]')): ?>
                <br/>
                <h4>Most killed:</h4>

                <p>
                    <?php
                    $victim = $this->get('pve[most_killed]')->createEntity();
                    echo $victim->getimage();
                    ?>
                    <?php echo $victim->encodeName(); ?>
                </p>

                <p>
                    <strong>Kills:</strong>
                    <?php echo $this->get('pve[most_killed]')->getCreatureKilled()->format(); ?>
                </p>
                <p>
                    <strong>Used weapon:</strong>
                    <?php
                    $weapon = $this->get('pve[most_killed]')->createMaterial();
                    echo $weapon->getImage();
                    ?>
                    <?php echo $weapon->encodeName(); ?>
                </p>
            <?php endif; ?>
            <?php if($this->get('pve[most_killed_by]')): ?>
                <br/>
                <h4>Most killed by:</h4>

                <p>
                    <?php
                    $killer = $this->get('pve[most_killed_by]')->createEntity();
                    echo $killer->getimage();
                    ?>
                    <?php echo $killer->encodeName(); ?>
                </p>

                <p>
                    <strong>Kills:</strong>
                    <?php echo $this->get('pve[most_killed_by]')->getPlayerKilled()->format(); ?>
                </p>
                <p>
                    <strong>Used weapon:</strong>
                    <?php
                    $weapon = $this->get('pve[most_killed_by]')->createMaterial();
                    echo $weapon->getImage();
                    ?>
                    <?php echo $weapon->encodeName(); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="span4 well well-small">
            <h3>Other</h3>
            <?php if($this->get('deaths')->count()): ?>
                <?php foreach($this->get('deaths') as $death): ?>
                    <p>
                        <strong><?php echo $death->getName(); ?></strong>
                        <?php echo $death->getTimes()->format(); ?>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p><strong>This player was not killed by outside influences.</strong></p>
            <?php endif; ?>
        </div>

    </div>

    <h2>Detailed Information</h2>

    <div class="row-fluid">

        <div class="span6 well well-small">
            <h3>Blocks</h3>

            <table class="table table-striped table-bordered table-vcenter">
                <thead>
                <tr>
                    <th style="text-align: center;">Block Type</th>
                    <th style="text-align: center;">Destroyed</th>
                    <th style="text-align: center;">Placed</th>
                </tr>
                </thead>
                <tbody class="content">
                <?php
                foreach($this->get('total_blocks') as $total):
                    $block = $total->createMaterial();
                    ?>
                    <tr>
                        <td>
                            <?php echo $block->getImage(32, 'img-polaroid'); ?>
                            <?php echo $block->getName(); ?>
                        </td>
                        <td>
                            <?php echo $total->getDestroyed()->format(); ?>
                        </td>
                        <td>
                            <?php echo $total->getPlaced()->format(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="span6 well well-small">
            <h3>Items</h3>
            <table class="table table-striped table-bordered table-vcenter">
                <thead>
                <tr>
                    <th style="text-align: center;">Item Type</th>
                    <th style="text-align: center;">Picked Up</th>
                    <th style="text-align: center;">Dropped</th>
                </tr>
                </thead>
                <tbody class="content">
                <?php
                foreach($this->get('total_items') as $total):
                    $item = $total->createMaterial();
                    ?>
                    <tr>
                        <td>
                            <?php echo $item->getImage(32, 'img-polaroid'); ?>
                            <?php echo $item->getName(); ?>
                        </td>
                        <td>
                            <?php echo $total->getPickedUp()->format(); ?>
                        </td>
                        <td>
                            <?php echo $total->getDropped()->format(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-block alert-error">
        <h3>Player not found!</h3>
    </div>
<?php endif; ?>