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
                <div class="span4">
                    <div class="well custom-well fixed-height statbox">

                        <h3 style="text-align:center;">Server Statistics</h3>

                        <dl class="dl-horizontal">
                            <dt>
                                <span class="label label-success">
                                    <i class="icon-bell"></i>
                                    <?php echo $this->get('serverstats[startup]') ?>
                                </span>
                            </dt>
                            <dd>Startup</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>
                                <span class="label label-warning">
                                    <i class="icon-lock"></i>
                                    <?php echo $this->get('serverstats[shutdown]') ?>
                                </span>
                            </dt>
                            <dd>Shutdown</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>
                                <span class="label label-important">
                                    <i class="icon-calendar"></i>
                                    <?php echo $this->get('serverstats[cur_uptime]') ?>
                                </span>
                            </dt>
                            <dd>Uptime</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>
                                <span class="label label-info">
                                <i class="icon-bullhorn"></i>
                                    <?php echo $this->get('serverstats[total_uptime]') ?>
                                </span>
                            </dt>
                            <dd>Gameplay</dd>
                        </dl>

                    </div>
                </div>
                <div class="span4">
                    <div class="well custom-well fixed-height statbox">

                        <h3 style="text-align:center;">Player Statistics</h3>
                        <dl class="dl-horizontal">
                            <dt style="width: 80px !important;">
                                <span class="badge badge-info"><i
                                        class="icon-user"></i> <?php echo $this->get('players[online]'); ?>
                                </span>
                            </dt>
                            <dd style="margin-left: 100px !important;">Currently online</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt style="width: 80px !important;">
                                <span class="badge badge-warning"><i
                                        class="icon-star"></i> <?php echo $this->get('players[tracked]') ?>
                                </span></dt>
                            <dd style="margin-left: 100px !important;">Tracked players</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt style="width: 80px !important;">
                                <span class="badge badge-success"><i
                                        class="icon-signal"></i> <?php echo $this->get('serverstats[max_players]') ?>
                                </span>
                            </dt>
                            <dd style="margin-left: 100px !important;">Maximum players</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt style="width: 80px !important;">
                                <span class="badge badge-info"><i
                                        class="icon-fire"></i> <?php echo $this->get('serverstats[total_logins]'); ?>
                                </span>
                            </dt>
                            <dd style="margin-left: 100px !important;">Number of logins</dd>
                        </dl>

                    </div>
                </div>
                <div class="span4">
                    <div class="well custom-well fixed-height statbox">

                        <h3 style="text-align:center;">Distances</h3>

                    </div>
                </div>
            </div>

            <div class="row-fluid dashboard">
                <div class="span4">Blocks</div>
                <div class="span8"></div>
            </div>

            <div class="row-fluid dashboard">
                <div class="span8"></div>
                <div class="span4"></div>
            </div>

        </section>
        <section id="players">
            <h1><i class="icon-group icon-large"></i> Player Information</h1>
        </section>
        <section id="world">
            <div class="row-fluid">
                <div class="span6">
                    <h1><i class="icon-picture icon-large"></i> Blocks</h1>
                </div>
                <div class="span6">
                    <h1><i class="icon-legal icon-large"></i> Items</h1>
                </div>
            </div>
        </section>
        <section id="deaths">
            <div class="row-fluid">
                <div class="span8">
                    <h1><i class="icon-tint icon-large"></i> Death Log</h1>
                </div>
                <div class="span4">
                    <h1> Death Statistics</h1>
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