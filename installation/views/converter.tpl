<h2><i class="icon-laptop icon-large" style="color: #ccc"></i> Converter settings</h2>
<?php
Util::showMessages('*', 'install/converter', 'alert alert-error');
?>

<?php if($this->get('state') == null): ?>
<p>Enter the login credentials for your old statistician database.</p>
<div class="alert">
    <div class="label label-warning">Warning</div> Be sure you have shut off the minecraft server before you continue!
</div>

<div class="control-group">
    <label for="host" class="control-label"><?php echo fText::compose('server'); ?>:</label>

    <div class="controls">
        <input type="text" name="host" id="host" value="<?php echo $this->get('host', 'localhost') ?>">
    </div>
</div>
<div class="control-group">
    <label for="user" class="control-label"><?php echo fText::compose('user'); ?>:</label>

    <div class="controls">
        <input type="text" name="user" id="user" value="<?php echo $this->get('user') ?>">
    </div>
</div>
<div class="control-group">
    <label for="pw" class="control-label"><?php echo fText::compose('pw'); ?>:</label>

    <div class="controls">
        <input type="password" name="pw" id="pw" autocomplete="off" value="<?php echo $this->get('pw') ?>">
    </div>
</div>
<div class="control-group">
    <label for="database" class="control-label"><?php echo fText::compose('db'); ?>:</label>

    <div class="controls">
        <input type="text" name="database" id="database" value="<?php echo $this->get('database') ?>">
    </div>
</div>
<?php endif; ?>

<?php if($this->get('state') == 2): ?>
<p> This could last a long time! Go and drink an coffee or finish your dinner...</p>
<p>Choose which entries do you want to convert:</p>

<div class="row">
    <div class="span6 offset2">

        <label class="checkbox">
            <input type="checkbox" name="convert[players]" id="convert_players" disabled="disabled"
                   checked="checked">
            Players (<?php echo $this->get('player_count'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[pvp]" id="convert_pvp" checked="checked">
            Player vs. Player Kills (<?php echo $this->get('total_pvp_kills'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[pve]" id="convert_pve" checked="checked">
            Player vs. Environment Kills (<?php echo $this->get('total_pve_kills'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[evp]" id="convert_evp" checked="checked">
            Environment vs. Player Kills (<?php echo $this->get('total_evp_kills'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[deaths]" id="convert_deaths" checked="checked">
            Death Causes (<?php echo $this->get('total_deaths'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[blocks]" id="convert_blocks" checked="checked">
            Total Blocks (<?php echo $this->get('total_blocks'); ?>)
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[items]" id="convert_items" checked="checked">
            Total Items (<?php echo $this->get('total_items'); ?>)
        </label>
    </div>
</div>
<input type="hidden" name="start" value="true">
<?php endif; ?>
<div class="form-actions">
    <button type="submit" name="converter_submit" value="1"
            class="btn btn-primary"><?php echo fText::compose('Next'); ?></button>
</div>

