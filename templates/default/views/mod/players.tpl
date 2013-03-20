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
            <a href="?page=player&name=<?php echo $player->getName(); ?>">
                <?php echo $player->getPlayerHead(32, 'img-polaroid'); ?>
                <?php echo $player->encodeName(); ?>
            </a>
        </td>
        <td>
            <?php
            if(!is_null($player->getLoginTime())):
                $time = new fTimestamp($player->getLoginTime());
                echo $time->format('d.m.Y - H:i');
                ?>
            <?php else: ?>
                <em>never</em>
            <?php endif; ?>
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