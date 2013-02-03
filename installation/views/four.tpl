<?php
Util::showMessages('*', 'install/four', 'alert alert-error');
?>

<?php echo $this->get('db_file'); ?>
<br>
<?php echo $this->get('cache_dir'); ?>
<br>
<?php echo $this->get('database'); ?>

<fieldset>
    <legend>Old Data</legend>
    <p>Do you have an older installation of statistician and want to transfer the statistics?</p>
    <label for="old_data_y">Yes: </label><input type="radio" name="old_data" id="old_data_y" value="yes"
                                                checked="checked">
    <label for="old_data_n">No: </label><input type="radio" name="old_data" id="old_data_n" value="no">
</fieldset>
<br>
<input type="submit" name="convert_submit" value="<?php echo fText::compose('submit'); ?>">