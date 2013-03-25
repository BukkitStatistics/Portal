<form name="install" method="post" class="form-horizontal">
    <h2><i class="icon-cogs" style="color:#ccc;"></i> General Settings
        <small>These can be changed later</small>
    </h2>
    <?php
    Util::showMessages('*', 'install/three', 'alert alert-error');
    ?>
    <div class="row-fluid">
        <div class="span6">
            <h3>General</h3>

            <div class="control-group">
                <label class="control-label" for="adminpw"><?php echo fText::compose('Admin Password') ?>:</label>

                <div class="controls"><input type="password" name="adminpw" id="adminpw"
                                             value="<?php echo $this->get('adminpw'); ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="adminemail"><?php echo fText::compose('Admin E-Mail') ?>:</label>

                <div class="controls"><input type="email" name="adminemail" id="adminemail"
                                             value="<?php echo $this->get('adminemail'); ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="title"><?php echo fText::compose('Page Title') ?>:</label>

                <div class="controls"><input type="text" name="title" id="title"
                                             value="<?php echo $this->get('title'); ?>"></div>
            </div>

            <h3>Date & Time</h3>

            <div class="control-group">
                <label class="control-label" for="timezone"><?php echo fText::compose('Timezone') ?>:</label>

                <div class="controls">
                    <select id="timezone" name="timezone">
                        <?php
                        foreach($this->get('timezones') as $key => $value) {
                            fHTML::printOption($value, $key, $this->get('timezone_active'));
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo fText::compose('Time Format') ?>:</label>

                <div class="controls">
                    <label class="radio"><input type="radio" name="time_format" id="time_format1" value="24"
                            <?php fHTML::showChecked(24, $this->get('time_format')) ?>>
                        24 hour format: <?php echo date('H:i - d.m.Y') ?>
                    </label>
                    <label class="radio"><input type="radio" name="time_format" id="time_format0" value="12"
                            <?php fHTML::showChecked(12, $this->get('time_format')) ?>>
                        12 hour
                        format: <?php echo date('g:i a - d.m.Y') ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="span6">
            <h3>Plugin</h3>

            <div class="control-group">
                <label class="control-label"><?php echo fText::compose('Messages') ?>:</label>

                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="welcome_msg" value="1"
                            <?php fHTML::showChecked(1, $this->get('welcome_msg')) ?>>
                        Show welcome message.
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="welcome_first_msg" value="1"
                            <?php fHTML::showChecked(1, $this->get('welcome_first_msg')) ?>>
                        Show first welcome message.<br/>
                        <small>Only on first join</small>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="ping"><?php echo fText::compose('Database Sync') ?>:</label>

                <div class="controls">
                    <input class="input-mini" type="number" name="ping" id="ping" value="<?php echo $this->get('ping') ?>">
                    <span class="help-block">Time in seconds. This value sets how often your server will update the database with values.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" name="general_submit" value="1" class="btn btn-primary">
            <?php echo fText::compose('Submit') ?>
        </button>
    </div>
</form>