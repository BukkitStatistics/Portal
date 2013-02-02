<?php
show_messages('*', 'install/three', 'alert alert-error');
?>

<fieldset>
    <legend>General Settings</legend>
    <label for="adminpw"><?php echo fText::compose('Admin Password'); ?>:</label>
    <input type="text" name="adminpw" id="adminpw" value="<?php echo $this->get('adminpw'); ?>"><br>
    <label for="title"><?php echo fText::compose('Title'); ?>:</label>
    <input type="text" name="title" id="title" value="<?php echo $this->get('title'); ?>"><br>
    Some more settings ;)
</fieldset>
<br>
<input type="submit" name="general_submit" value="<?php echo fText::compose('submit'); ?>" class="btn">