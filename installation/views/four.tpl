<h2><i class="icon-check icon-large" style="color: #ccc;"></i> Your settings</h2>

<?php
Util::showMessages('*', 'install/four', 'alert alert-error');
?>

<p>Review the settings you have made. If something is wrong, please go back and change it.</p>

<div class="row">
    <div class="span4">
        <p>
            <?php if($this->get('cache_write')): ?>
            <i class="icon-ok icon-2x" style="color: #46a546"></i> <?php echo $this->get('cache_dir'); ?>
            <?php else: ?>
            <i class="icon-remove icon-2x" style="color: #e9322d"></i> <?php echo $this->get('cache_dir'); ?>
            <?php endif; ?>
        </p>
        <p><i class="icon-ok icon-2x" style="color: #46a546"></i> Database</p>
        <p>
            <strong>Title:</strong> <?php echo fSession::get('settings[title]'); ?>
        </p>
    </div>
    <div class="span4">show some settings</div>
</div>
<br><br>
<h2><i class="icon-book icon-large" style="color: #ccc;"></i> Old Data</h2>
<p>Do you have an older installation of statistician and want to transfer the statistics?</p>
<div class="alert alert-warning">
    <span class="label">Warning</span> Every new data will be deleted!
</div>

<label class="radio">
    <input type="radio" name="old_data" id="old_data_y" value="yes"
            checked="checked">
    Yes. Please transfer my old data!
</label>
<label class="radio">
    <input type="radio" name="old_data" id="old_data_n" value="no">
    No. I want to start with fresh statistics!
</label>
<div class="form-actions">
    <a href="?step=three" class="btn btn-inverse">Back</a>
    <button type="submit" name="convert_submit" value="1" class="btn btn-primary"><?php echo fText::compose('submit'); ?></button>
</div>