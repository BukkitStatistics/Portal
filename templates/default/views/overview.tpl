<div class="row">
<div id="content" class="span10 pull-right">
<section id="dashboard">
<div class="row-fluid">
    <div class="span3">
        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
            <h1 style="text-align:center;"><i class="icon-group icon-large"></i></h1>

            <h3 style="text-align:center;">
                <?php echo $this->get('players[online]'); ?>
                online
            </h3>
        </div>
    </div>


    <div class="span3">
        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
            <h1 style="text-align:center;"><i class="icon-pencil icon-large"></i></h1>

            <h3 style="text-align:center;">
                <?php echo $this->get('players[tracked]'); ?>
                tracked
            </h3>
        </div>
    </div>


    <div class="span3">
        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
            <h1 style="text-align:center;"><i class="icon-remove-sign icon-large"></i></h1>

            <h3 style="text-align:center;">
                <?php echo $this->get('players[killed]'); ?>
                killed
            </h3>
        </div>
    </div>


    <div class="span3">
        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
            <h1 style="text-align:center;"><i class="icon-tint icon-large"></i></h1>

            <h3 style="text-align:center;">
                <?php echo $this->get('players[died]'); ?>
                died
            </h3>
        </div>
    </div>
</div>

<div class="section-split"></div>
<div class="page-header">
    <h1>
        <i class="icon-tasks icon-large"></i> Dashboard
        <small>Some general statistics</small>
    </h1>
</div>

<div class="row-fluid dashboard">
    <div class="span8">
        <div class="well custom-well">
            <h3>Server Statistics</h3>

            <div class="row-fluid">
                <div class="span12">
                    <!-- TODO: find a fluid solution -.-' -->
                    <table class="table no-border statbox-table">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bell"></i> <?php echo $this->get('serverstats[startup]'); ?>
                                </span>
                            </td>
                            <td>
                                Startup
                            </td>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-group"></i> <?php echo $this->get('players[online]'); ?>
                                </span>
                            </td>
                            <td>
                                Currently online
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-warning">
                                    <i class="icon-lock"></i> <?php echo $this->get('serverstats[shutdown]'); ?>
                                </span>
                            </td>
                            <td>
                                Shutdown
                            </td>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-star"></i> <?php echo $this->get('players[tracked]'); ?>
                                </span>
                            </td>
                            <td>
                                Tracked players
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-calendar"></i> <?php echo $this->get('serverstats[cur_uptime]'); ?>
                                </span>
                            </td>
                            <td>
                                Uptime
                            </td>
                            <td>
                                <span class="label label-success">
                                    <i class="icon-signal"></i>
                                    <?php echo $this->get('serverstats[max_players][0]'); ?> -
                                    <?php echo $this->get('serverstats[max_players][1]'); ?>
                                </span>
                            </td>
                            <td>
                                Maximum players
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bullhorn"></i> <?php echo $this->get('serverstats[total_uptime]'); ?>
                                </span>
                            </td>
                            <td>
                                Gameplay
                            </td>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-fire"></i> <?php echo $this->get('serverstats[total_logins]'); ?>
                                </span>
                            </td>
                            <td>
                                Number of logins
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="well custom-well fixed-height">

            <h3 style="text-align:center;">Distances</h3>

            <div class="row-fluid">
                <div class="span11 offset1">
                    <table class="table no-border statbox-table">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-globe"></i> <?php echo $this->get('distance[total]'); ?>
                                </span>
                            </td>
                            <td>
                                Total distance
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-exchange"></i> <?php echo $this->get('distance[foot]'); ?>
                                </span>
                            </td>
                            <td>
                                By foot
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-shopping-cart"></i> <?php echo $this->get('distance[minecart]'); ?>
                                </span>
                            </td>
                            <td>
                                By minecart
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-tablet"></i> <?php echo $this->get('distance[boat]'); ?>
                                </span>
                            </td>
                            <td>
                                By boat
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid dashboard">
    <div class="span4">
        <div class="well custom-well">
            <h3 style="text-align: center">Blocks</h3>

            <div class="row-fluid">
                <div class="span11 offset1">
                    <table class="table no-border statbox-table">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('blocks[placed]'); ?>
                                </span>
                            </td>
                            <td>
                                Total placed
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('blocks[most_placed][1]'), 16); ?>
                                    <?php echo $this->get('blocks[most_placed][0]'); ?>
                                </span>
                            </td>
                            <td>
                                Most placed
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('blocks[destroyed]'); ?>
                                </span>
                            </td>
                            <td>
                                Total destroyed
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('blocks[most_destroyed][1]'), 16); ?>
                                    <?php echo $this->get('blocks[most_destroyed][0]'); ?>
                                </span>
                            </td>
                            <td>
                                Most destroyed
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="span8">
        <div class="well custom-well fixed-height">
            <h3>Online Players</h3>
            <div data-mod="players_online">
                <?php $this->place('players_online'); ?>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid dashboard">
    <div class="span8">
        <div class="well custom-well fixed-height">
            <h3>Death Statistics</h3>

            <div class="fluid-row">
                <div class="span4">
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-success no-img">
                            <?php echo $this->get('deaths[total]') ?>
                        </span>
                        </dt>
                        <dd>Total Kills</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-success no-img">
                            <?php echo $this->get('deaths[deaths]') ?>
                        </span>
                        </dt>
                        <dd>Total Deaths</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-important">
                            <?php echo Material::getMaterialImg($this->get('deaths[top_weapon][1]')) ?>
			            </span>
                        </dt>
                        <dd>Best Weapon</dd>
                    </dl>
                </div>

                <div class="span4">
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-success no-img">
                            <?php echo $this->get('deaths[pve]') ?>
                        </span>
                        </dt>
                        <dd>PvE Kills</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-important">
                            <?php echo Entity::getEntityImg($this->get('deaths[most_dangerous][1]')) ?>
			            </span>
                        </dt>
                        <dd>Most Dangerous</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-important">
                            <?php echo Entity::getEntityImg($this->get('deaths[most_killed_mob][1]')) ?>
			            </span>
                        </dt>
                        <dd>Most Killed</dd>
                    </dl>
                </div>

                <div class="span4">
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-success no-img">
                            <?php echo $this->get('deaths[pvp]') ?>
                        </span>
                        </dt>
                        <dd>PvP Kills</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-important">
                            <a href="?page=player&name=<?php echo $this->get('deaths[top_killer][1]')->getUrlName(); ?>">
                                <?php echo $this->get('deaths[top_killer][1]')->getPlayerHead(); ?>
                            </a>
			            </span>
                        </dt>
                        <dd>Most Kills</dd>
                    </dl>
                    <dl class="dl-horizontal dl-stats">
                        <dt>
                        <span class="badge badge-important">
                            <a href="?page=player&name=<?php echo $this->get('deaths[most_killed_player][1]')->getUrlName(); ?>">
                                <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
                            </a>
			            </span>
                        </dt>
                        <dd>Most Deaths</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="well custom-well fixed-height">
            <h3 style="text-align: center">Items</h3>

            <div class="row-fluid">
                <div class="span11 offset1">
                    <table class="table no-border statbox-table">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('items[picked]'); ?>
                                </span>
                            </td>
                            <td>
                                Total picked up
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('items[most_picked][1]'), 16); ?>
                                    <?php echo $this->get('items[most_picked][0]'); ?>
                                </span>
                            </td>
                            <td>
                                Most picked up
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('items[dropped]'); ?>
                                </span>
                            </td>
                            <td>
                                Total dropped
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <?php echo Material::getMaterialImg($this->get('items[most_dropped][1]'), 16); ?>
                                    <?php echo $this->get('items[most_dropped][0]'); ?>
                                </span>
                            </td>
                            <td>
                                Most dropped
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<section id="players">
    <h1><i class="icon-group icon-large"></i> Player Information</h1>

    <div class="well custom-wel" data-mod="players" id="playersBlock">

        <?php $this->place('total_players'); ?>

    </div>
</section>
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

            <div class="well custom-well" data-mod="total_items" id="worldBlocks">

                <?php $this->place('total_items'); ?>

            </div>
        </div>
    </div>
</section>
<section id="deaths">
    <div class="row-fluid">
        <div class="span12">
            <h1><i class="icon-tint icon-large"></i> Death Log</h1>

            <div class="well custom-well" style="padding: 10px;" id="deathsBlock">

                <?php $this->place('death_log'); ?>

            </div>
        </div>
    </div>
</section>
</div>
<div class="span2 pull-left">
    <div class="nav nav-sidebar well">
        <ul class="nav nav-list">
            <li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="#players"><i class="icon-group"></i> Players</a></li>
            <li><a href="#world"><i class="icon-picture"></i> World</a></li>
            <li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
        </ul>
    </div>
</div>
</div>