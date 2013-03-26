<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-cog icon-3x" style="color:#ccc;"></i></h2>
        <h3>Database</h3>
    </div>
    <div class="span10 well">
        <div class="alert alert-danger alert-block">
            <p>
                <span class="label label-important">Warning!</span> Be careful with these settings. When you fill in
                wrong
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
                    <input type="text" name="db_pw" id="db_pw" class="input-block-level"
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