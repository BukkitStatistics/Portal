<?php if($this->get('players')->count() == 0): ?>
<div class='force-center'><em>No players tracked</em></div>
<?php else: ?>
<table class="table table-striped table-bordered table-hover sortable" id="playersTable">
    <thead>
    <tr>
        <th class="sort-button" data-type="1" data-sort="desc">
            Name
        </th>
        <th class="sort-button" data-type="2" data-sort="desc">
            Last Seen
        </th>
        <th class="sort-button" data-type="3" data-sort="desc">
            Date Joined
        </th>
    </tr>
    </thead>
    <tbody class="content">

        <?php foreach($this->get('players') as $player): ?>
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
<div id="playersPagination" class="pagination-centered"></div>

<script type="text/javascript">
    $(document).ready(function () {
        callModulePage(
            'players',
            <?php echo $this->get('players')->getPages(); ?>,
            <?php echo $this->get('players')->getPage(); ?>
        );
    });
</script>
<?php endif; ?>