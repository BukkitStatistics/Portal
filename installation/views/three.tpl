<form name="install" method="post">
    <h2><i class="fa fa-cogs"></i> General Settings
        <small>These can be changed later</small>
    </h2>
    {{ Util.showMessages('*', 'install/three', 'alert alert-danger') }}
    <div class="row">
        <div class="col-md-6">
            <h3>General</h3>

            <div class="form-group">
                <label class="control-label" for="adminpw">Admin Password:</label>

                <input type="password" name="adminpw" id="adminpw" class="form-control"
                       value="{{ adminpw }}">
            </div>

            <div class="form-group">
                <label class="control-label" for="adminpw2">Retype password:</label>

                <input type="password" name="adminpw2" id="adminpw2" class="form-control"
                        value="{{ adminpw2 }}">
            </div>

            <hr>

            <div class="form-group">
                <label class="control-label" for="adminemail">Admin E-Mail:</label>

                <input type="email" name="adminemail" id="adminemail" class="form-control"
                       value="{{ adminemail }}">
            </div>
            <div class="form-group">
                <label class="control-label" for="title">Page Title:</label>

                <input type="text" name="title" id="title" class="form-control"
                        value="{{ title }}">
            </div>

            <h3>Date & Time</h3>

            <div class="form-group">
                <label class="control-label" for="timezone">Timezone:</label>

                <select id="timezone" name="timezone" class="form-control">
                    {% for key, value in timezones %}
                        {{ printOption(value, key, timezone_active) }}
                    {% endfor %}
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Time format</label>

                <div class="radio">
                    <label>
                        <input type="radio" name="time_format" id="time_format1"
                               value="24" {{ showChecked(24, time_format) }}>
                        24 hour format: {{ 'now'|date('H:i - d.m.Y') }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="time_format" id="time_format0"
                               value="12" {{ showChecked(12, time_format) }}>
                        12 hour format: {{ 'now'|date('g:i a - d.m.Y') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Plugin</h3>

            <div class="form-group">
                <label class="control-label">Messages</label>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="welcome_msg" value="1" {{ showChecked(1, welcome_msg) }}>
                        Show welcome message.
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="welcome_first_msg" value="1" {{ showChecked(1, welcome_first_msg) }}>
                        Show first welcome message.<br/>
                        <small>Only on first join</small>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="ping">Database Sync</label>

                <input type="number" name="ping" id="ping" class="form-control"
                       value="{{ ping }}">
                <span class="help-block">Time in seconds. This value sets how often your server will update the database with values.</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" name="general_submit" value="1" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>