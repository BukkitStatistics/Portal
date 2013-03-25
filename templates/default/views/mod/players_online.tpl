<?php if($this->get('online_players')->count() == 0): ?>
    <div class='force-center'><em>No players online</em></div>
<?php
else: ?>
    <table class="table table-striped table-hover table-vcenter">
        <thead>
        <tr>
            <th class="sort-button" data-type="1" data-sort="asc">Name</th>
            <th class="sort-button" data-type="2" data-sort="asc">Logged in since</th>
            <th>Play time</th>
        </tr>
        </thead>
        <tbody class="content">
        <?php foreach($this->get('online_players') as $player): ?>
            <tr>
                <td>
                    <a href="?page=player&name=<?php echo $player->getName(); ?>">
                        <?php echo $player->getPlayerHead(); ?>
                        <?php echo $player->encodeName(); ?>
                    </a>
                </td>
                <td>
                    <?php
                    $time = new fTimestamp($player->getLoginTime());
                    echo $time->format('H:i:s - d.m.Y');
                    ?>
                </td>
                <td>
                    <?php echo Util::formatSeconds(new fTimestamp($player->getPlaytime())); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>