<?php
Util::showMessages('*', 'install/two', 'alert alert-error');
?>

<fieldset>
    <legend>Database</legend>
    <label for="type"><?php echo fText::compose('type'); ?>:</label>
    <select name="type" id="type">
        <?php
    foreach($this->get('db_type') as $value => $text) {
    fHTML::printOption($text, $value, $this->get('active_type'));
    }
        ?>
    </select><br>
    <label for="host"><?php echo fText::compose('server'); ?>:</label>
    <input type="text" name="host" id="host" placeholder="localhost" value="<?php echo $this->get('host') ?>"><br>
    <label for="dbfile"><?php echo fText::compose('dbfile'); ?>:</label>
    <input type="text" name="dbfile" id="dbfile" placeholder="/path/to/database/file"
           value="<?php echo $this->get('dbfile') ?>"><br>
    <label for="user"><?php echo fText::compose('user'); ?>:</label>
    <input type="text" name="user" id="user" placeholder="user" value="<?php echo $this->get('user') ?>"><br>
    <label for="pw"><?php echo fText::compose('pw'); ?>:</label>
    <input type="text" name="pw" id="pw" placeholder="password" value="<?php echo $this->get('pw') ?>"><br>
    <label for="database"><?php echo fText::compose('db'); ?>:</label>
    <input type="text" name="database" id="database" placeholder="yasp"
           value="<?php echo $this->get('database') ?>"><br>
    <label for="prefix"><?php echo fText::compose('prefix'); ?>:</label>
    <input type="text" name="prefix" id="prefix" value="<?php echo $this->get('prefix' , 'yasp_') ?>"><br>
</fieldset>
<br>
<input type="submit" name="db_submit" value="<?php echo fText::compose('submit'); ?>" class="btn">