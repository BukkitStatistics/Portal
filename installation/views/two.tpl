<?php
Util::showMessages('*', 'install/two', 'alert alert-error');
?>

<fieldset>
    <legend>Database</legend>
    <label for="host"><?php echo fText::compose('server'); ?>:</label>
    <input type="text" name="host" id="host" placeholder="localhost" value="<?php echo $this->get('host') ?>"><br>
    <label for="user"><?php echo fText::compose('user'); ?>:</label>
    <input type="text" name="user" id="user" placeholder="user" value="<?php echo $this->get('user') ?>"><br>
    <label for="pw"><?php echo fText::compose('pw'); ?>:</label>
    <input type="text" name="pw" id="pw" placeholder="password" value="<?php echo $this->get('pw') ?>"><br>
    <label for="database"><?php echo fText::compose('db'); ?>:</label>
    <input type="text" name="database" id="database" placeholder="yasp"
           value="<?php echo $this->get('database') ?>"><br>
    <label for="prefix"><?php echo fText::compose('prefix'); ?>:</label>
    <input type="text" name="prefix" id="prefix" value="<?php echo $this->get('prefix',
                                                                              'yasp') ?>"><?php echo fText::compose('Your tables will look like "prefix_tablename"'); ?>
    <br>
</fieldset>
<br>
<input type="submit" name="db_submit" value="<?php echo fText::compose('submit'); ?>" class="btn">