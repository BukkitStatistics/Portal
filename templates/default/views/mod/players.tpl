<?php if($this->get('all_players')->count() == 0): ?>
<div class='force-center'><em>No players tracked</em></div>
<?php else: ?>
<table class="table table-striped table-bordered table-hover sortable" id="playersTable">
    <thead>
    <tr>
        <th class="sort-button" data-type="name" data-sort="desc">
            Name
            <?php if($this->get('sort[name]') == 'desc'): ?>
                <i class="icon-sort-down"></i>
            <?php elseif($this->get('sort[name]') == 'asc'):  ?>
                <i class="icon-sort-up"></i>
            <?php else:  ?>
                <i class="icon-sort"></i>
            <?php endif; ?>
        </th>
        <th class="sort-button" data-type="prefix_detailed_log_players.time" data-sort="desc">
            Last Seen
            <?php if($this->get('sort[time]') == 'desc'): ?>
                <i class="icon-sort-down"></i>
            <?php elseif($this->get('sort[time]') == 'asc'): ?>
                <i class="icon-sort-up"></i>
            <?php
            else: ?>
                <i class="icon-sort"></i>
            <?php endif; ?>
        </th>
        <th class="sort-button" data-type="first_login" data-sort="desc">
            Date Joined
            <?php if($this->get('sort[first_login]') == 'desc'): ?>
                <i class="icon-sort-down"></i>
            <?php elseif($this->get('sort[first_login]') == 'asc'): ?>
                <i class="icon-sort-up"></i>
            <?php
            else: ?>
                <i class="icon-sort"></i>
            <?php endif; ?>
        </th>
    </tr>
    </thead>
    <tbody class="content">

        <?php foreach($this->get('all_players') as $player): ?>
    <tr>
        <td>
            <a href="?page=player&name=<?php echo $player->getUrlName(); ?>">
                <?php echo $player->getPlayerHead(); ?>
                <?php echo $player->getName(); ?>
            </a>
        </td>
        <td>
            <?php
            try {
                $logins = $player->buildDetailedLogPlayers();

                $logins = $logins->filter(array('getIsLogin=' => true))
                    ->sort('getTime', 'desc')->slice(0, 1);

                $time = new fTimestamp($logins->getRecord(0)->getTime());
                echo $time->format('D d.m.Y');
            } catch(fNoRemainingException $e) {
                echo fText::compose('never');
            }
            ?>

        </td>
        <td>
            <?php
            $time = new fTimestamp($player->getFirstLogin());
            echo $time->format('D d.m.Y');
            ?>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination pagination-centered"></div>
<?php endif; ?>