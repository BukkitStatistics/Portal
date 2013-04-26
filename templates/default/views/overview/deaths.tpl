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
            <?php echo Material::getMaterialImg($this->get('deaths[top_weapon][1]'), 32, null, true); ?>
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
            <?php echo Entity::getEntityImg($this->get('deaths[most_dangerous][1]'), 32, null, true); ?>
        </span> Most Dangerous
    </div>
    <div class="span4">
        <span class="badge badge-success grid-img">
            <?php echo Entity::getEntityImg($this->get('deaths[most_killed_mob][1]'), 32, null, true); ?>
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
                    <?php echo $this->get('deaths[top_killer][1]')->getPlayerHead(32, null, true); ?>
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
                    <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(32, null, true); ?>
                </a>
            <?php else: ?>
                <?php echo $this->get('deaths[most_killed_player][1]')->getPlayerHead(); ?>
            <?php endif; ?>
        </span> Most Deaths
    </div>
</div>