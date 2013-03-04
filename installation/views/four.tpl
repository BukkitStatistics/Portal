<div class="row">
    <div class="span12">
        <h2><i class="icon-check icon-large" style="color: #ccc;"></i> Your settings</h2>

        <?php
        Util::showMessages('*', 'install/four', 'alert alert-error');
        ?>

        <p>Review the settings you have made. If something is wrong, please go back and change it.</p>
    </div>
</div>

<div class="row">
    <div class="span6">
        <h3>General</h3>
        <p>
            <?php if($this->get('cache_write')): ?>
            <i class="icon-ok icon-large" style="color: #46a546"></i>
            <?php else: ?>
            <i class="icon-remove icon-large" style="color: #e9322d"></i>
            <?php endif; ?>
            <?php echo $this->get('cache_dir'); ?>
        </p>
        <p><i class="icon-ok icon-large" style="color: #46a546"></i> Database</p>
        <p>
            <strong>Title:</strong> <?php echo $this->get('title') ?>
        </p>
        <p>
            <strong>Admin Email:</strong> <?php echo $this->get('adminemail') ?>
        </p>
        <h3>Date & Time</h3>
        <p>
            <strong>Timezone:</strong> <?php echo $this->get('timezone'); ?>
        </p>
        <p>
            <strong>Time Format:</strong> <?php echo $this->get('time_format'); ?>
        </p>
    </div>
    <div class="span6">
        <h3>Plugin</h3>
        <p>
            <?php if($this->get('welcome_msg')): ?>
            <i class="icon-ok icon-large" style="color: #46a546"></i>
            <?php else:  ?>
            <i class="icon-remove icon-large" style="color: #e9322d"></i>
            <?php endif; ?>
             Show welcome message
        </p>
        <p>
            <?php if($this->get('welcome_first_msg')): ?>
            <i class="icon-ok icon-large" style="color: #46a546"></i>
            <?php else: ?>
            <i class="icon-remove icon-large" style="color: #e9322d"></i>
            <?php endif; ?>
            Show first welcome message
        </p>
        <p>
            <strong>Database sync:</strong> every <?php echo $this->get('ping') ?> seconds
        </p>
    </div>
</div>
<br><br>
<div class="row">
    <div class="span12">
        <h2><i class="icon-book icon-large" style="color: #ccc;"></i> Old Data</h2>

        <p>Do you have an older installation of statistician and want to transfer the statistics?</p>

        <div class="alert">
            <span class="label label-warning">Warning</span> Every new data will be deleted!
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
            <button type="submit" name="convert_submit" value="1"
                    class="btn btn-primary"><?php echo fText::compose('submit'); ?></button>
        </div>
    </div>
</div>