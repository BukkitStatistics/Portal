<form name="install" method="post" class="form-horizontal">
    <h2><i class="icon-cogs" style="color:#ccc;"></i> General Settings
        <small>These can be changed later</small>
    </h2>
    {{ Util.showMessages('*', 'install/three', 'alert alert-error') }}
    <div class="row-fluid">
        <div class="span6">
            <h3>General</h3>

            <div class="control-group">
                <label class="control-label" for="adminpw">Admin Password:</label>

                <div class="controls"><input type="password" name="adminpw" id="adminpw"
                                             value="{{ adminpw }}"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="adminemail">Admin E-Mail:</label>

                <div class="controls"><input type="email" name="adminemail" id="adminemail"
                                             value="{{ adminemail }}"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="title">Page Title:</label>

                <div class="controls"><input type="text" name="title" id="title"
                                             value="{{ title }}"></div>
            </div>

            <h3>Date & Time</h3>

            <div class="control-group">
                <label class="control-label" for="timezone">Timezone:</label>

                <div class="controls">
                    <select id="timezone" name="timezone">
                        {% for key, value in timezones %}
                            {{ printOption(value, key, timezone_active) }}
                        {% endfor %}
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Time format</label>

                <div class="controls">
                    <label class="radio"><input type="radio" name="time_format" id="time_format1"
                                                value="24" {{ showChecked(24, time_format) }}>
                        24 hour format: {{ 'now'|date('H:i - d.m.Y') }}
                    </label>
                    <label class="radio"><input type="radio" name="time_format" id="time_format0"
                                                value="12" {{ showChecked(12, time_format) }}>
                        12 hour
                        format: {{ 'now'|date('g:i a - d.m.Y') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="span6">
            <h3>Plugin</h3>

            <div class="control-group">
                <label class="control-label">Messages</label>

                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="welcome_msg" value="1" {{ showChecked(1, welcome_msg) }}>
                        Show welcome message.
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="welcome_first_msg" value="1" {{ showChecked(1, welcome_first_msg) }}>
                        Show first welcome message.<br/>
                        <small>Only on first join</small>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="ping">Database Sync</label>

                <div class="controls">
                    <input class="input-mini" type="number" name="ping" id="ping"
                           value="{{ ping }}">
                    <span class="help-block">Time in seconds. This value sets how often your server will update the database with values.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" name="general_submit" value="1" class="btn btn-primary">
            Submit
        </button>
    </div>
</form>