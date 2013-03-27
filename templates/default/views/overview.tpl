<!-- <overview> -->
<div class="row-fluid quick-info">
    <div class="span3 well">
        <h1 style="text-align:center;"><i class="icon-group icon-large"></i></h1>

        <h3 style="text-align:center;"><?php echo $this->get('players[online]'); ?> online</h3>
    </div>
    <div class="span3 well">
        <h1 style="text-align:center;"><i class="icon-pencil icon-large"></i></h1>

        <h3 style="text-align:center;"><?php echo $this->get('players[tracked]'); ?> tracked</h3>
    </div>
    <div class="span3 well">
        <h1 style="text-align:center;"><i class="icon-remove-sign icon-large"></i></h1>

        <h3 style="text-align:center;"><?php echo $this->get('players[killed]'); ?> killed</h3>
    </div>
    <div class="span3 well">
        <h1 style="text-align:center;"><i class="icon-arrow-up icon-large"></i></h1>

        <h3 style="text-align:center;"><?php echo $this->get('serverstats[uptime_perc]'); ?>% uptime</h3>
    </div>
</div>
<div class="row-fluid">
    <div class="container span3">

        <!-- <navigation> -->
        <div class="left-menu hidden-phone" id="left-menu">
            <div class="nav nav-sidebar well">
                <ul class="nav nav-list" id="nav-menu">
                    <li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
                    <li class="divider"></li>
                    <li><a href="#players"><i class="icon-group"></i> Players</a></li>
                    <li><a href="#world"><i class="icon-picture"></i> World</a></li>
                    <li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
                </ul>
            </div>
        </div>
        <!-- </navigation> -->

    </div>

    <div class="span9" id="page-body">

        <!-- <dashboard> -->
        <section id="dashboard">
            <div class="row-fluid">
                <div class="span8 well well-small module module-big" id="module-online-players">
                    <h3>Online Players</h3>

                    <div class="online-players">
                        <?php $this->place('players_online'); ?>
                    </div>

                </div>
                <div class="span4 well well-small module module-small">
                    <h3>Server</h3>

                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bell"></i> <?php echo $this->get('serverstats[startup]'); ?>
                                </span>
                            </td>
                            <td>Startup</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-warning">
                                    <i class="icon-lock"></i> <?php echo $this->get('serverstats[shutdown]'); ?>
                                </span>
                            </td>
                            <td>Shutdown</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-calendar"></i> <?php echo $this->get('serverstats[cur_uptime]'); ?>
                                </span>
                            </td>
                            <td>Uptime</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bullhorn"></i> <?php echo $this->get('serverstats[playtime]'); ?>
                                </span>
                            </td>
                            <td>Gameplay</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 well well-small module module-small">
                    <h3>Players</h3>
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-group"></i> <?php echo $this->get('players[online]'); ?>
                                </span>
                            </td>
                            <td>Currently online</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-star"></i> <?php echo $this->get('players[tracked]'); ?>
                                </span>
                            </td>
                            <td>Tracked</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-success">
                                    <i class="icon-signal"></i> <?php echo $this->get('serverstats[max_players][0]'); ?>
                                </span>
                            </td>
                            <td>Maximum</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-fire"></i> <?php echo $this->get('serverstats[total_logins]'); ?>
                                </span>
                            </td>
                            <td>Total logins</td>
                        </tr>
                    </table>
                </div>
                <div class="span4 well well-small module module-small">
                    <h3>Blocks</h3>
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('blocks[placed]'); ?>
                                </span>
                            </td>
                            <td>Placed</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('blocks[most_placed][1]'), 16); ?>
                                    <?php echo $this->get('blocks[most_placed][0]'); ?>
                                </span>
                            </td>
                            <td>Top placed</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('blocks[destroyed]'); ?>
                                </span>
                            </td>
                            <td>Broken</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('blocks[most_destroyed][1]'), 16); ?>
                                    <?php echo $this->get('blocks[most_destroyed][0]'); ?>
                                </span>
                            </td>
                            <td>Top broken</td>
                        </tr>
                    </table>
                </div>
                <div class="span4 well well-small module module-small">
                    <h3>Items</h3>
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('items[picked]'); ?>
                                </span>
                            </td>
                            <td>Picked up</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('items[most_picked][1]'), 16); ?>
                                    <?php echo $this->get('items[most_picked][0]'); ?>
                                </span>
                            </td>
                            <td>Most picked up</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('items[dropped]'); ?>
                                </span>
                            </td>
                            <td>Dropped</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('items[most_dropped][1]'), 16); ?>
                                    <?php echo $this->get('items[most_dropped][0]'); ?>
                                </span>
                            </td>
                            <td>Most dropped</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 well well-small module module-small">
                    <h3>Distances</h3>
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-globe"></i> <?php echo $this->get('distance[total]'); ?>
                                </span>
                            </td>
                            <td>Total</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-exchange"></i> <?php echo $this->get('distance[foot]'); ?>
                                </span>
                            </td>
                            <td>By foot</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-shopping-cart"></i> <?php echo $this->get('distance[minecart]'); ?>
                                </span>
                            </td>
                            <td>By minecart</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-tablet"></i> <?php echo $this->get('distance[boat]'); ?>
                                </span>
                            </td>
                            <td>By boat</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-umbrella"></i> <?php echo $this->get('distance[swimmed]'); ?>
                                </span>
                            </td>
                            <td>Swum</td>
                        </tr>
                    </table>
                </div>
                <div class="span8 well well-small module module-big">
                    <h3>Deaths</h3>

                    <div class="row-fluid grid">
                        <div class="span4">
                            <span class="badge badge-success no-img">
                                <?php echo $this->get('deaths[total]'); ?>
                            </span>
                            Total Kills
                        </div>
                        <div class="span4">
                            <span class="badge badge-success no-img">
                                <?php echo $this->get('deaths[deaths]'); ?>
                            </span>
                            Total Deaths
                        </div>
                        <div class="span4">
                            <span class="badge badge-success grid-img">
                                <?php echo Material::getMaterialImg($this->get('deaths[top_weapon][1]')); ?>
                            </span>
                            Best Weapon
                        </div>
                    </div>
                    <div class="row-fluid grid">
                        <div class="span4">
                            <span class="badge badge-success no-img">
                                <?php echo $this->get('deaths[pve]'); ?>
                            </span>
                            PvE Kills
                        </div>
                        <div class="span4">
                            <span class="badge badge-success grid-img">
                                <?php echo Entity::getEntityImg($this->get('deaths[most_dangerous][1]')); ?>
                            </span>
                            Most Dangerous
                        </div>
                        <div class="span4">
                            <span class="badge badge-success grid-img">
                                <?php echo Entity::getEntityImg($this->get('deaths[most_killed_mob][1]')); ?>
                            </span>
                            Most killed
                        </div>
                    </div>
                    <div class="row-fluid grid">
                        <div class="span4">
                            <span class="badge badge-success no-img">
                                <?php echo $this->get('deaths[pvp]'); ?>
                            </span>
                            PvP Kills
                        </div>
                        <div class="span4">
                            <span class="badge badge-important grid-img">
                                <?php if($this->get('deaths[top_killer][1]')->getName() != 'none'): ?>
                                    <a href="?page=player&name=<?php echo $this->get('deaths[top_killer][1]')->getName(); ?>">
                                        <?php echo $this->get('deaths[top_killer][1]')->getPlayerHead(); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->get('deaths[top_killer][1]')->getPlayerHead(); ?>
                                <?php endif; ?>
                            </span>
                            Most Kills
                        </div>
                        <div class="span4">
                            <span class="badge badge-important grid-img">
                                <?php if($this->get('deaths[most_killed_player][1]')->getName() != 'none'): ?>
                                    <a href="?page=player&name=<?php echo $this->get('deaths[most_killed_player][1]')
                                                                                ->getName(); ?>">
                                        <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
                                <?php endif; ?>
                            </span>
                            Most Deaths
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- </dashboard> -->

        <!-- <players> -->
        <section id="players">
            <h1><i class="icon-group"></i> Players
                <small>tracked on the server</small>
            </h1>

            <div data-mod="players" id="playersBlock">

                <?php $this->place('total_players'); ?>

            </div>
        </section>
        <!-- </players> -->

        <!-- <world> -->
        <section id="world">
            <div class="row-fluid">
                <div class="span6">
                    <h1><i class="icon-picture icon-large"></i> Blocks</h1>

                    <div class="well custom-well paginator" data-mod="total_blocks" id="worldBlocks">
                        <?php $this->place('total_blocks'); ?>
                    </div>
                </div>
                <div class="span6">
                    <h1><i class="icon-legal icon-large"></i> Items</h1>

                    <div class="well custom-well" data-mod="total_items" id="worldItems">
                        <?php $this->place('total_items'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- </world> -->

        <!-- <deaths> -->
        <section id="deaths">
            <h1><i class="icon-tint icon-large"></i> Death Log
                <small>PVP, PVE and EVP kills</small>
            </h1>
            <div class="well custom-well" style="padding: 10px;" id="deathsBlock">

                <?php $this->place('death_log'); ?>

            </div>
        </section>
        <!-- </deaths> -->

    </div>
</div>
<!-- </overview> -->