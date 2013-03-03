<fieldset id="processing">
    <p>Database converting is in progress! Please be patient</p>

    <p>Currently converting: <?php echo $this->get('current'); ?></p>

    <div class="progress progress-striped active">
        <div class="bar" style="width: <?php echo $this->get('perc'); ?>%;"></div>
    </div>
    <a href="?step=converter"
       class="btn btn-primary">Stop</a>
    <a href="<?php echo $this->get('next_step') ?>"
       class="btn <?php echo ($this->get('next_step') != '' ? 'btn-success' : 'disabled') ?>">Next Step</a>
</fieldset>