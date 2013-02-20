<fieldset id="processing">
    <p>Database converting is in progress! Please be patient</p>

    <p>Currently converting: <?php echo $this->get('current'); ?></p>

    <div class="progress progress-striped active">
        <div class="bar" style="width: <?php echo $this->get('perc'); ?>%;"></div>
    </div>
    <a href="<?php echo $this->get('next_step') ?>"
       class="btn btn-primary <?php echo ($this->get('next_step') != '' ? '' : 'disabled') ?>">Next Step</a>
</fieldset>