<div class="row-fluid">
    <div class="span10 offset2">
        <div class="page-header">
            <h1>
                <i class="icon-cogs icon-large"></i> Admin Panel
                <small>Configuration for the web portal and plugin.</small>
            </h1>
        </div>
        <?php Util::showMessages('input', 'admin', 'alert alert-block alert-danger'); ?>
    </div>
</div>
<form action="" method="post" name="settings" id="settings" class="form-setup">
<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-user icon-3x" style="color:#ccc;"></i></h2>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="adminemail"><strong>E-Mail</strong></label>
                    <input type="email" name="adminemail" id="adminemail" class="input-block-level"
                           value="<?php echo $this->get('adminemail'); ?>"/>

                    <label for="language"><strong>Language</strong></label>
                    <select id="language" name="language" class="input-block-level">
                        <?php

                        foreach($this->get('langs') as $key => $value)
                            fHTML::printOption($value, $key, $this->get('language'));
                        ?>
                    </select>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="adminpw"><strong>Password</strong></label>
                    <input type="password" name="adminpw" id="adminpw" class="input-block-level"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-pencil icon-3x" style="color:#ccc;"></i></h2>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="portal_title"><strong>Server name</strong></label>
                    <input type="text" name="portal_title" id="portal_title" class="input-block-level"
                           value="<?php echo $this->get('portal_title'); ?>"/>

                    <label for="time_format1"><strong>Time Format</strong></label>
                    <label class="radio">
                        <input type="radio" name="time_format" id="time_format1"
                               value="24" <?php fHTML::showChecked(24,
                                                                   $this->get('time_format')) ?>>
                        24 hour format: <?php echo date('H:i - d.m.Y') ?>
                    </label>
                    <label class="radio">
                        <input type="radio" name="time_format" id="time_format0"
                               value="12" <?php fHTML::showChecked(12,
                                                                   $this->get('time_format')) ?>>
                        12 hour format: <?php echo date('g:i a - d.m.Y') ?>
                    </label>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="logo_url"><strong>Logo URL</strong></label>
                    <input type="text" name="logo_url" id="logo_url" class="input-block-level"
                           value="<?php echo $this->get('logo_url'); ?>"/>

                    <label for="timezone"><strong>Timezone</strong></label>
                    <select id="timezone" name="timezone" class="input-block-level">
                        <?php

                        foreach($this->get('times') as $key => $value)
                            fHTML::printOption($value, $key, $this->get('timezone'));
                        ?>
                    </select>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-cog icon-3x" style="color:#ccc;"></i></h2>
    </div>
    <div class="span10 well">
        <div class="alert alert-danger alert-block">
            <p>
                <span class="label label-important">Warning!</span> Be careful with these settings. When you fill in wrong
                values the portal will not be reachable anymore.<br>
                If this happens try to fill in the db.php manually. It is located here: <em>include/config/db.php</em>.
            </p>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <div class="span8">
                        <fieldset>
                            <label for="db_host"><strong>Database Host</strong></label>
                            <input type="text" name="db_host" id="db_host" class="input-block-level"
                                   value="<?php echo $this->get('db_host'); ?>"/>
                        </fieldset>
                    </div>
                    <div class="span4">
                        <fieldset>
                            <label for="db_port"><strong>Port</strong></label>
                            <input type="text" name="db_port" id="db_port" class="input-block-level"
                                   value="<?php echo $this->get('db_port') ?>"/>
                        </fieldset>
                    </div>
                </div>
                <fieldset>
                    <label for="db_user"><strong>Database Username</strong></label>
                    <input type="text" name="db_user" id="db_user" class="input-block-level"
                           value="<?php echo $this->get('db_user'); ?>"/>

                    <label for="ping">
                        <strong>Database Sync Time</strong>
                        <small>Time in seconds</small>
                    </label>
                    <input type="text" name="ping" id="ping" class="input-block-level"
                           value="<?php echo $this->get('ping'); ?>"/>
                        <span class="help-block">
                            This value sets how often your server will update the database with values.<br>
                            <span class="label label-important"><strong>Warning!</strong></span>
                            <span
                                class="text-error">Be careful with low values! Low values could crash your server!</span>
                        </span>
                </fieldset>
            </div>
            <div class="span6">
                <div class="row-fluid">
                    <div class="span8">
                        <fieldset>
                            <label for="db_name"><strong>Database Name</strong></label>
                            <input type="text" name="db_name" id="db_name" class="input-block-level"
                                   value="<?php echo $this->get('db_name'); ?>"/>
                        </fieldset>
                    </div>
                    <div class="span4">
                        <fieldset>
                            <label for="db_prefix"><strong>Prefix</strong></label>

                            <div class="input-append">
                                <input type="text" name="db_prefix" id="db_prefix" class="span8"
                                       value="<?php echo $this->get('db_prefix') ?>"/>
                                <span class="add-on">_</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <fieldset>
                    <label for="db_pw"><strong>Database Password</strong></label>
                    <input type="password" name="db_pw" id="db_pw" class="input-block-level"
                           value="<?php echo $this->get('db_pw'); ?>"/>

                    <label for="delay">
                        <strong>Delay Time</strong>
                        <small>Time in seconds</small>
                    </label>
                    <input type="text" name="delay" id="delay" class="input-block-level"
                           value="<?php echo $this->get('delay'); ?>"/>
                        <span class="help-block">
                            This value sets the delay after the players will be tracked by the system.<br>
                            <span class="label label-info"><strong>Info!</strong></span>
                            <span
                                class="text-info">To track the players immediately set value to <strong>0</strong>.</span>
                        </span>
                </fieldset>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-comment icon-3x" style="color:#ccc;"></i></h2>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="first_join_msg"><strong>First join message</strong></label>
                    <label for="show_first_join_msg" class="checkbox">
                        <input type="hidden" name="show_first_join_msg" value="0"/>
                        <input type="checkbox" value="1" name="show_first_join_msg" id="show_first_join_msg"
                            <?php fHTML::showChecked('1', $this->get('show_first_join_msg')); ?>>
                        Show
                    </label>
                    <input type="text" name="first_join_msg" id="first_join_msg"
                           class="input-block-level"
                           value="<?php echo $this->get('first_join_msg'); ?>"/>
                </fieldset>
                    <span class="help-block">
                        Use <span class="label label-info">&lt;PLAYER&gt;</span> to display the name of the player.
                    </span>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="welcome_msg"><strong>Welcome message</strong></label>
                    <label for="show_welcome_msg" class="checkbox">
                        <input type="hidden" name="show_welcome_msg" value="0"/>
                        <input type="checkbox" value="1" name="show_welcome_msg" id="show_welcome_msg"
                            <?php fHTML::showChecked('1', $this->get('show_welcome_msg')); ?>>
                        Show
                    </label>
                    <input type="text" name="welcome_msg" id="welcome_msg"
                           class="input-block-level"
                           value="<?php echo $this->get('welcome_msg'); ?>"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span10 offset2">
        <div class="form-actions">
            <div class="pull-left">
                <button class="btn btn-large btn-primary" name="save" value="true" id="Save">
                    <i class="icon-save"></i> Save
                </button>
            </div>
            <div class="pull-right">
                <button class="btn btn-large btn-danger" name="logout" value="true">
                    <i class="icon-signout"></i> Logout
                </button>
                <a href="./" class="btn btn-large">
                    <i class="icon-home"></i> Home
                </a>
            </div>
        </div>
    </div>
</div>
</form>