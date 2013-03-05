<div class="span10 offset2" id="content">
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
