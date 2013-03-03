<h2><i class="icon-desktop" style="color:#ccc;"></i> Database</h2>

<?php
Util::showMessages('*', 'install/two', 'alert alert-error');
?>

<p>Enter your database credentials. The credentials must be the same as in the plugin config file.</p>
<div class="alert alert-info"><span class="label label-info">Important</span> The plugin has to be installed before this
    installation
</div>

<div class="control-group">
    <label class="control-label" for="host"><?php echo fText::compose('server'); ?>:</label>

    <div class="controls">
        <input type="text" name="host" id="host" placeholder="localhost" value="<?php echo $this->get('host') ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="user"><?php echo fText::compose('user'); ?>:</label>

    <div class="controls">
        <input type="text" name="user" id="user" placeholder="user" value="<?php echo $this->get('user') ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="pw"><?php echo fText::compose('pw'); ?>:</label>

    <div class="controls">
        <input type="text" name="pw" id="pw" placeholder="password" value="<?php echo $this->get('pw') ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="database"><?php echo fText::compose('db'); ?>:</label>

    <div class="controls">
        <input type="text" name="database" id="database" placeholder="yasp"
               value="<?php echo $this->get('database') ?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="prefix"><?php echo fText::compose('prefix'); ?>:</label>

    <div class="controls">
        <div class="input-append">
            <input type="text" name="prefix" id="prefix" value="<?php echo $this->get('prefix', 'yasp') ?>">
            <span class="add-on">_</span>
        </div>
        <span class="help-inline">Tables will look like this: prefix_tablename</span>
    </div>
</div>
<div class="form-actions">
    <button type="submit" name="db_submit" value="1" class="btn btn-primary"><?php echo fText::compose('submit'); ?></button>
</div>