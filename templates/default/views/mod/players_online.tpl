<?php if($this->get('online_players')->count() == 0): ?>
    <div class='force-center'><em>No players online</em></div>
<?php
else: ?>
    <?php foreach($this->get('online_players') as $player): ?>

        <div class="online-player-heads">
            <a href="?page=player&name=<?php echo $player->getName(); ?>">
                <?php echo $player->getPlayerHead(64, 'img-polaroid'); ?>
            </a>
        </div>

    <?php endforeach; ?>
<?php endif; ?>