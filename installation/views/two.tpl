<h2><i class="fa fa-desktop"></i> Database</h2>
{{ Util.showMessages('*', 'install/two', 'alert alert-danger') }}

<p>Enter your database credentials. The credentials must be the same as in the plugin config file.</p>

<div class="alert alert-info">
    <span class="label label-info">Important</span>
    The plugin has to be installed and configured before this installation.
</div>

<form name="install" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="host">Hostname</label>

                <div class="row">
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="host" id="host"
                               value="{{ host|default('localhost') }}"/>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="text" name="port" id="port"
                               value="{{ port|default('3306') }}"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="user">Username</label>

                        <input class="form-control" type="text" name="user" id="user"
                               value="{{ user }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="pw">Password</label>

                        <input class="form-control" type="password" name="pw" id="pw" autocomplete="off"
                               value="{{ pw }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="database">Database:</label>

                <input class="form-control" type="text" name="database" id="database"
                       value="{{ database }}">
            </div>
            <div class="form-group">
                <label class="control-label" for="prefix">Prefix:</label>

                <div class="input-group">
                    <input type="text" class="form-control" name="prefix" id="prefix" value="{{ prefix|default('stats') }}">
                    <span class="input-group-addon">_</span>
                </div>
                <small class="help-block">Optional. Tables will look like this: prefix_tablename.</small>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" name="db_submit" value="1" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>