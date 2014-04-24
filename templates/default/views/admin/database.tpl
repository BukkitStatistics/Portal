<div class="row">
    <div class="col-md-12 well">
        <div class="alert alert-danger">
            <p>
                <span class="label label-danger">Warning!</span> Be careful with these settings. When you fill in
                wrong values the portal will not be reachable anymore.<br>
                If this happens try to fill in the db.php manually. It is located here: <em>include/config/db.php</em>.
            </p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <fieldset>
                            <label for="db_host"><strong>Database Host</strong></label>
                            <input type="text" name="db_host" id="db_host" class="form-control"
                                   value="{{ db_host }}"/>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset>
                            <label for="db_port"><strong>Port</strong></label>
                            <input type="text" name="db_port" id="db_port" class="form-control"
                                   value="{{ db_port }}"/>
                        </fieldset>
                    </div>
                </div>
                <fieldset>
                    <label for="db_user"><strong>Database Username</strong></label>
                    <input type="text" name="db_user" id="db_user" class="form-control"
                           value="{{ db_user }}"/>

                    <label for="ping">
                        <strong>Database Sync Time</strong>
                        <small>Time in seconds</small>
                    </label>
                    <input type="text" name="ping" id="ping" class="form-control"
                           value="{{ ping }}"/>
                        <span class="help-block">
                            This value sets how often your server will update the database with values.<br>
                            <span class="label label-danger"><strong>Warning!</strong></span>
                            <span class="text-danger">Be careful with low values! Low values could crash your server!</span>
                        </span>
                </fieldset>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <fieldset>
                            <label for="db_name"><strong>Database Name</strong></label>
                            <input type="text" name="db_name" id="db_name" class="form-control"
                                   value="{{ db_name }}"/>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset>
                            <label for="db_prefix"><strong>Prefix</strong></label>

                            <div class="input-group">
                                <input type="text" name="db_prefix" id="db_prefix" class="form-control"
                                       value="{{ db_prefix }}"/>
                                <span class="input-group-addon">_</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <fieldset>
                    <label for="db_pw"><strong>Database Password</strong></label>
                    <input type="text" name="db_pw" id="db_pw" class="form-control"
                           value="{{ db_pw }}"/>

                    <label for="delay">
                        <strong>Delay Time</strong>
                        <small>Time in seconds</small>
                    </label>
                    <input type="text" name="delay" id="delay" class="form-control"
                           value="{{ delay }}"/>
                        <span class="help-block">
                            This value sets the delay after the players will be tracked by the system.<br>
                            <span class="label label-info"><strong>Info!</strong></span>
                            <span
                                class="text-info">To track the players immediately set value to <strong>0</strong>.</span>
                        </span>
                </fieldset>
            </div>
        </div>
    </div>
</div>