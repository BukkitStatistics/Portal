<?php if($this->get('type') == 'critical'): ?>
<div class="alert alert-danger alert-block">
    <h3><?php echo fText::compose('Sorry. An unexpected error occurred.') ?></h3>

    <p><?php echo $this->get('e_message'); ?></p>
    <p><strong>Type:</strong> <?php echo $this->get('e_name'); ?></p>
    <strong>File:</strong> <?php echo $this->get('e_file'); ?>:<?php echo $this->get('e_line'); ?>
    <br><br>
    <pre><?php echo $this->get('e_backtrace');  ?></pre>
</div>
<?php elseif($this->get('type') == 'error'): ?>
<div class="alert alert-block">
    <h3><?php echo fText::compose('Sorry. An error occurred.') ?></h3>

    <p><?php echo $this->get('e_message'); ?></p>
</div>
<?php elseif($this->get('type') == '404'): ?>
<div class="alert alert-block">
    <h3><?php echo fText::compose('404 - Page not found.') ?></h3>

    <p><?php echo fText::compose('The page you are trying to access does not exist.') ?></p>
</div>
<?php else: ?>
<div class="alert alert-info alert-block">
    <h3><?php echo fText::compose('Sorry. An error occurred.') ?></h3>
    <p><?php fText::compose('Please try again later.') ?></p>
</div>
<?php endif; ?>