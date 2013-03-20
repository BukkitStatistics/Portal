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
<div class="page-header">
    <h1>
        <i class="icon-tasks icon-large"></i> Dashboard
        <small>Some general statistics</small>
    </h1>
</div>

<div class="row-fluid dashboard">
    <div class="span8">
        <div class="well custom-well fixed-height">
            <h3>Server Statistics</h3>

            <div class="row-fluid">
                <div class="span12">
                    <!-- TODO: find a fluid solution -.-' -->
                    <table class="table no-border statbox-table">
                        <tr>
                            <th class="statbox-head" colspan="2">General</th>
                            <th class="statbox-head" colspan="2">Player</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bell"></i> <?php echo $this->get('serverstats[startup]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Startup
                            </td>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-group"></i> <?php echo $this->get('players[online]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Currently online
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-warning">
                                    <i class="icon-lock"></i> <?php echo $this->get('serverstats[shutdown]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Shutdown
                            </td>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-star"></i> <?php echo $this->get('players[tracked]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Tracked
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-important">
                                    <i class="icon-calendar"></i> <?php echo $this->get('serverstats[cur_uptime]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Uptime
                            </td>
                            <td>
                                <span class="label label-success">
                                    <i class="icon-signal"></i>
                                    <?php echo $this->get('serverstats[max_players][0]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Maximum
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-bullhorn"></i> <?php echo $this->get('serverstats[playtime]'); ?>
                                </span>
                            </td>
                            <td class="desc">
                                Gameplay
                            </td>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-fire"></i> <?php echo $this->get('serverstats[total_logins]'); ?>
                                </span>
                            </td>
                            <td class="desc">
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
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-globe"></i> <?php echo $this->get('distance[total]'); ?>
                                </span>
                            </td>
                            <td>
                                Total
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
        <div class="well custom-well fixed-height">
            <h3 style="text-align: center">Blocks</h3>

            <div class="row-fluid">
                <div class="span11 offset1">
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('blocks[placed]'); ?>
                                </span>
                            </td>
                            <td>
                                Placed
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
                                Top placed
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('blocks[destroyed]'); ?>
                                </span>
                            </td>
                            <td>
                                Destroyed
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
                                Top destroyed
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
            <div class="row-fluid grid">
                <div class="span4">
                    <span class="badge badge-success no-img">
                        <?php echo $this->get('deaths[total]'); ?>
                    </span> Total Kills
                </div>
                <div class="span4">
                     <span class="badge badge-success no-img">
                        <?php echo $this->get('deaths[deaths]'); ?>
                    </span> Total Deaths
                </div>
                <div class="span4">
                     <span class="badge badge-success grid-img">
                        <?php echo Material::getMaterialImg($this->get('deaths[top_weapon][1]')); ?>
                    </span> Best Weapon
                </div>
            </div>
            <div class="row-fluid grid">
                <div class="span4">
                    <span class="badge badge-success no-img">
                        <?php echo $this->get('deaths[pve]'); ?>
                    </span> PvE Kills
                </div>
                <div class="span4">
                     <span class="badge badge-success grid-img">
                        <?php echo Entity::getEntityImg($this->get('deaths[most_dangerous][1]')); ?>
                    </span> Most Dangerous
                </div>
                <div class="span4">
                     <span class="badge badge-success grid-img">
                        <?php echo Entity::getEntityImg($this->get('deaths[most_killed_mob][1]')); ?>
                    </span> Most killed
                </div>
            </div>
            <div class="row-fluid grid">
                <div class="span4">
                    <span class="badge badge-success no-img">
                        <?php echo $this->get('deaths[pvp]'); ?>
                    </span> PvP Kills
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
                    </span> Most Kills
                </div>
                <div class="span4">
                    <span class="badge badge-important grid-img">
                        <?php if($this->get('deaths[most_killed_player][1]')->getName() != 'none'): ?>
                            <a href="?page=player&name=<?php echo $this->get('deaths[most_killed_player][1]')->getName(); ?>">
                                <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
                            </a>
                        <?php else: ?>
                            <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
                        <?php endif; ?>
                        </span> Most Deaths
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="well custom-well fixed-height">
            <h3 style="text-align: center">Items</h3>

            <div class="row-fluid">
                <div class="span11 offset1">
                    <table class="table no-border statbox-table-small">
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-plus"></i> <?php echo $this->get('items[picked]'); ?>
                                </span>
                            </td>
                            <td>
                                Picked up
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
                                Top picked up
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label label-info">
                                    <i class="icon-minus"></i> <?php echo $this->get('items[dropped]'); ?>
                                </span>
                            </td>
                            <td>
                                Dropped
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
                                Top dropped
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
    <div class="page-header">
        <h1>
            <i class="icon-group icon-large"></i>
            Players
            <small>Tracked on this server</small>
        </h1>
    </div>

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
            <div class="page-header">
                <h1>
                    <i class="icon-tint icon-large"></i>
                    Death Log
                    <small>PVP, PVE and EVP kills</small>
                </h1>
            </div>

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