<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container force-center">
            <a class="brand" href="../">
                LOGOURL
            </a>


            <ul class="nav pull-right">
                <li>
                    <a> <?php if($this->get('online')) {
                        echo "Server status: <span class='label label-success'>Online</span>";
                    }
                    else {
                        echo "Server status: <span class='label label-important'>Offline</span>";
                    } ?> </a>
                </li>
                <?php if($this->get('login') == "Guest") {
                echo '<li><a href="?page=login">Log in</a></li>';
            }
            else {
                ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdwn"
                       data-target="#"><?php echo $this->get('login'); ?><b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li role="menuitem"><a href="contents/default/settings/"><i class="icon-wrench"></i>
                            Settings</a></li>
                        <li role="menuitem"><a href="contents/default/logout/"><i class="icon-globe"></i> Log out</a>
                        </li>
                    </ul>
                </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span2">
            <div class="nav sidebar-nav well" style="position: fixed;" id="menubar">
                <ul class="nav nav-list">
                    <li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
                    <li class="divider"></li>
                    <li><a href="#players"><i class="icon-group"></i> Players</a></li>
                    <li><a href="#world"><i class="icon-picture"></i> World</a></li>
                    <li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
                </ul>
            </div>
        </div>
        <div class="span10" id="content">
            <!-- ===== Notifications ===== -->
            <section id="dashboard">
                <?php //@include ('./yasp/notifications.php'); ?>

                <!-- ===== Header ===== -->
                <?php //@include ('./yasp/modules/header.php'); ?>


                <!-- ===== Dashboard ===== -->
                <div class="section-split"></div>
                <h1><i class="icon-tasks icon-large"></i> Dashboard</h1>

                <div class="row-fluid dashboard">
                    <div class="span4"><?php //@include ('./yasp/modules/dash_serverstats.php'); ?></div>
                    <div class="span4"><?php //@include ('./yasp/modules/dash_playerstats.php'); ?></div>
                    <div class="span4"><?php //@include ('./yasp/modules/dash_distances.php'); ?></div>
                </div>

                <div class="row-fluid dashboard">
                    <div class="span4"><?php //@include ('./yasp/modules/dash_blocks.php'); ?></div>
                    <div class="span8"><?php //@include ('./yasp/modules/dash_players.php'); ?></div>
                </div>

                <div class="row-fluid dashboard">
                    <div class="span8"><?php //@include ('./yasp/modules/dash_deaths.php'); ?></div>
                    <div class="span4"><?php //@include ('./yasp/modules/dash_items.php'); ?></div>
                </div>
            </section>

            <!-- ===== Players ===== -->
            <section id="players">
                <div class="section-split"></div>
                <h1><i class="icon-group icon-large"></i> Player Information</h1>
                <?php //@include ('./yasp/modules/players_search.php'); ?>

                <?php //@include ('./yasp/modules/players_table.php'); ?>
            </section>
            <!-- ===== World ===== -->
            <section id="world">
                <div class="section-split"></div>
                <div class="row-fluid">
                    <div class="span6">
                        <h1><i class="icon-picture icon-large"></i> Blocks</h1>
                        <?php //@include ('./yasp/modules/world_blocks.php'); ?>
                    </div>
                    <div class="span6">
                        <h1><i class="icon-legal icon-large"></i> Items</h1>
                        <?php //@include ('./yasp/modules/world_items.php'); ?>
                    </div>
                </div>
            </section>

            <!-- ===== Deaths ===== -->
            <section id="deaths">
                <div class="section-split"></div>
                <div class="row-fluid">
                    <div class="span8">
                        <h1><i class="icon-tint icon-large"></i> Death Log</h1>
                        <?php //@include ('./yasp/modules/deaths_log.php'); ?>
                    </div>
                    <div class="span4">
                        <h1> Death Statistics</h1>
                        <?php //@include ('./yasp/modules/deaths_stats.php'); ?>
                    </div>
                </div>
            </section>
        </div>
    </div>