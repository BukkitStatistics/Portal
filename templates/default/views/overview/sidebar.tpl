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
    <?php if(DB_TYPE == 'default' && $this->get('multi')): ?>
        <div class="well">
            <h4>Other servers</h4>
            <?php
            foreach($this->get('multi') as $server):
                $info = Util::getFileContents(
                    fURL::getDomain() . fURL::get() . '?server=' . $server['slug'] . '&api=true&type=server_stats',
                    true);
                $info = fJSON::decode($info, true);
                ?>
                <?php if($info['current_uptime'] > 0): ?>
                <i class="icon-circle text-success"></i>
            <?php else: ?>
                <i class="icon-circle text-error"></i>
            <?php endif; ?>
                <a href="?server=<?php echo $server['slug']; ?>">
                    <?php echo $server['name']; ?> -
                    <?php echo $info['online_players']; ?>/<?php echo $info['players_allowed']; ?>
                </a>
                <br>
            <?php endforeach; ?>
        </div>
    <?php elseif(DB_TYPE != 'default'): ?>
        <div class="well">
            <a href="?server=default"><h4><i class="icon-reply"></i> Back to main server</h4></a>
        </div>
    <?php endif; ?>
</div>
<!-- </navigation> -->