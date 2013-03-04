<h2><i class="icon-cogs" style="color:#ccc;"></i> General Settings</h2>

<?php
Util::showMessages('*', 'install/three', 'alert alert-error');
?>

<p>Set up your general settings. They can be changed later via the admin panel.</p>

<div class="control-group">
    <label class="control-label" for="adminpw"><?php echo fText::compose('Admin Password'); ?>:</label>

    <div class="controls">
        <input type="password" name="adminpw" id="adminpw" value="<?php echo $this->get('adminpw'); ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="title"><?php echo fText::compose('Title'); ?>:</label>

    <div class="controls">
        <input type="text" name="title" id="title" value="<?php echo $this->get('title'); ?>">
    </div>
</div>
<div class="form-actions">
    <button type="submit" name="general_submit" value="1" class="btn btn-primary"><?php echo fText::compose('submit'); ?></button>
</div>