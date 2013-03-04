<h2><i class="icon-magic icon-large" style="color: #ccc"></i> Processing</h2>
<p>Database converting is in progress! Please be patient.</p>

    <?php if($this->get('next_step') == ''): ?>
        <div class="alert alert-info">
            <i class="icon-refresh icon-spin"></i>
            <strong>Converting</strong> <?php echo $this->get('current'); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-success">
            <strong>Step (<?php echo $this->get('current'); ?>) finished.</strong> Now press the <em>Next Step</em> Button.
        </div>
    <?php endif; ?>
<div class="progress <?php echo ($this->get('next_step') != '' ? 'progress-success' : 'progress-striped active') ?>">
    <div class="bar" style="width: <?php echo $this->get('perc'); ?>%;"></div>
</div>
<a href="?step=converter"
   class="btn btn-inverse">Stop</a>
<a <?php if($this->get('next_step') != ''): ?>
        href="<?php echo $this->get('next_step'); ?>"
    <?php endif; ?>
   class="btn <?php echo ($this->get('next_step') != '' ? 'btn-success' : 'disabled') ?>">Next Step</a>
