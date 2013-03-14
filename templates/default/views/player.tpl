<?php if(!is_null($this->get('player'))): ?>
    <h1>
        <?php echo $this->get('player')->getPlayerHead(64, 'img-polaroid'); ?>
        <?php echo $this->get('player')->encodeName(); ?>
        <?php if($this->get('player')->getOnline()): ?>
            <span class='label label-success'>In-Game</span>"
        <?php else: ?>
            <span class='label label-important'>Offline</span>
        <?php endif; ?>
    </h1>


    <p>
        <strong>Joined on:</strong>
        <?php
            $time = new fTimestamp($this->get('player')->getFirstLogin());
            echo $time->format('d.m.Y - H:i');
        ?>
    </p>
    <p>
        <strong>Last seen:</strong>
        <?php
            if(!is_null($this->get('player')->getLoginTime())):
            $time = new fTimestamp($this->get('player')->getLoginTime());
            echo $time->format('d.m.Y - H:i');
        ?>
        <?php else:  ?>
            <em>never</em>
        <?php endif; ?>
    </p>
    <p>
        <strong>Playtime:</strong>
        <?php
            echo 0;
        ?>
    </p>


    <div class="row-fluid" style="width:100% !important;">
        <div class="span4" style="width: 30% !important;">
            <h3>Distances</h3>

            <p>
                <strong>Travelled:</strong>
                <?php echo $this->get('distance')->getTotal()->format(); ?> meters
            </p>

            <p>
                <strong>Walked:</strong>
                <?php echo $this->get('distance')->getFoot()->format(); ?> meters
            </p>

            <p>
                <strong>Minecarted:</strong>
                <?php echo $this->get('distance')->getMinecart()->format(); ?> meters
            </p>

            <p>
                <strong>Boated:</strong>
                <?php echo $this->get('distance')->getBoat()->format(); ?> meters
            </p>

            <p>
                <strong>Piggybacked:</strong>
                <?php echo $this->get('distance')->getPig()->format(); ?> meters
            </p>
            <p>
                <strong>Swum:</strong>
                <?php echo $this->get('distance')->getSwimmed()->format(); ?> meters
            </p>
        </div>

        <div class="span4" style="width: 30% !important;">
            <h3>Blocks</h3>

            <p>
                <strong>Total Blocks Placed:</strong>
                <?php echo $this->get('blocks[placed]')->format(); ?> Blocks
            </p>

            <p>
                <strong>Most Popular Block Placed:</strong>
                <?php
                    $block = $this->get('blocks[most_placed]')->createMaterial();
                    echo $block->getImage();
                ?>

                <?php echo $this->get('blocks[most_placed]')->getPlaced()->format(); ?>
            </p>

            <p>
                <strong>Total Blocks Destroyed:</strong>
                <?php echo $this->get('blocks[destroyed]')->format(); ?> Blocks
            </p>

            <p>
                <strong>Most Popular Block Destroyed:</strong>
                <?php
                $block = $this->get('blocks[most_destroyed]')->createMaterial();
                echo $block->getImage();
                ?>

                <?php echo $this->get('blocks[most_destroyed]')->getDestroyed()->format(); ?>
            </p>
        </div>

        <div class="span4" style="width: 30% !important;">
            <h3>Items</h3>

            <p>
                <strong>Total Items Picked Up:</strong>
                <?php echo $this->get('items[picked]')->format(); ?> Items
            </p>

            <p>
                <strong>Most Popular Item Picked Up:</strong>
                <?php
                $item = $this->get('items[most_picked]')->createMaterial();
                echo $item->getImage();
                ?>

                <?php echo $this->get('items[most_picked]')->getPickedUp()->format(); ?>
            </p>

            <p>
                <strong>Total Items Dropped:</strong>
                <?php echo $this->get('items[dropped]')->format(); ?> Items
            </p>

            <p>
                <strong>Most Popular Item Dropped:</strong>
                <?php
                $item = $this->get('items[most_dropped]')->createMaterial();
                echo $item->getImage();
                ?>

                <?php echo $this->get('items[most_dropped]')->getDropped()->format(); ?>
            </p>
        </div>

    </div>
    <div class="row-fluid" style="width:100% !important;">

        <div class="span4" style="width: 30% !important;">
            <h3>PvP Stats</h3>

            <p>
                <strong>Total Kills:</strong>
                <?php echo $this->get('pvp[kills]')->format(); ?>
            </p>
            <p>
                <strong>Total Deaths:</strong>
                <?php echo $this->get('pvp[deaths]')->format(); ?>
            </p>
            <p>
                <strong>Favorite Weapon:</strong>
            </p>
            <p>
                <strong>Sworn Enemy:</strong>
            </p>
            <?php if($this->get('pvp[most_killed]')): ?>
                <br/>
                <h4>Most killed:</h4>
                <p>
                    <?php
                    $victim = $this->get('pvp[most_killed]')->createPlayer('victim_id');
                    echo $victim->getPlayerHead();
                    ?>
                    <?php echo $victim->encodeName(); ?>
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
                    <?php
                    $killer = $this->get('pvp[most_killed_by]')->createPlayer('player_id');
                    echo $killer->getPlayerHead();
                    ?>
                    <?php echo $killer->encodeName(); ?>
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
            <?php endif;  ?>
        </div>

        <div class="span4" style="width: 30% !important;">
            <h3>PvE Stats</h3>

            <p><strong>PVE
                    Kills:</strong>
            </p>

            <p><strong>PVE
                    Deaths:</strong>
            </p>

            <p><strong>Most Killed Creature:</strong>


            </p>

            <p><strong>Most Dangerous Creature:</strong>


            </p>
        </div>

        <div class="span4" style="width: 30% !important;">
            <h3>Other deaths</h3>

            <p><strong>Other Type Deaths:</strong>

            </p>

            <p><strong>Falling Deaths:</strong>

            </p>

            <p><strong>Drowning Deaths:</strong>

            </p>

            <p><strong>Suffocation Deaths:</strong>

            </p>

            <p><strong>Lightning Deaths:</strong>

            </p>

            <p><strong>Lava Deaths:</strong>

            </p>

            <p><strong>Fire Deaths:</strong>

            </p>

            <p><strong>Fire Tick Deaths:</strong>

            </p>

            <p><strong>Explosion Deaths:</strong>

            </p>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-block alert-error">
        <h3>Player not found!</h3>
    </div>
<?php endif; ?>