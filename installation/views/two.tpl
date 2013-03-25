<h2><i class="icon-desktop"></i> Database</h2>
<?php
Util::showMessages('*', 'install/two', 'alert alert-error');
?>

<p>Enter your database credentials. The credentials must be the same as in the plugin config file.</p>

<div class="alert alert-info">
    <span class="label label-info">Important</span>
    The plugin has to be installed and configured before this installation.
</div>

<form name="install" method="post">
    <div class="row-fluid">
        <div class="span5">

            <div class="control-group">
                <label class="control-label" for="host">Hostname</label>

                <div class="controls controls-row">
                    <input class="input-large" type="text" name="host" id="host"
                           value="<?php echo $this->get('host', 'localhost'); ?>"/>
                    <span style="position: relative; bottom: 5px; font-weight: bold;">:</span>
                    <input class="input-small" type="text" name="port" id="port"
                           value="<?php echo $this->get('port', 3306); ?>"/>
                </div>

            </div>

            <div class="row-fluid">
                <div class="span5">
                    <div class="control-group">
                        <label class="control-label" for="user">Username</label>

                        <div class="controls">
                            <input class="input-medium" type="text" name="user" id="user"
                                                     value="<?php echo $this->get('user'); ?>">
                        </div>
                    </div>
                </div>
                <div class="span5" style="padding-left: 10px;">
                    <div class="control-group">
                        <label class="control-label" for="pw">Password</label>

                        <div class="controls">
                            <input class="input-medium" type="password" name="pw" id="pw" autocomplete="off"
                                   value="<?php echo $this->get('pw'); ?>">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="span5">
            <div class="control-group">
                <label class="control-label" for="database">Database:</label>

                <div class="controls">
                    <input type="text" name="database" id="database" style="width:230px;"
                           value="<?php echo $this->get('db'); ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="prefix">Prefix:</label>

                <div class="controls">
                    <div class="input-append">
                        <input type="text" name="prefix" id="prefix"
                               value="<?php echo $this->get('prefix', 'stats'); ?>">
                        <span class="add-on">_</span>
                    </div>
                    <span class="help-inline"><small>Optional. Tables will look like this: prefix_tablename.
                        </small></span>
                </div>
            </div>

        </div>
        <div class="span2">
            <div class="form-actions" style="position:relative; top:60px; right:80px;">
                <button type="submit" name="db_submit" value="1" class="btn btn-primary">
                    <?php echo fText::compose('Submit'); ?>
                </button>
            </div>
        </div>
    </div>

</form>