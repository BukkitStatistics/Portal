<form name="install" method="post">
    <h2><i class="fa fa-check fa-lg"></i> Your settings</h2>

    {{ Util.showMessages('*', 'install/four', 'alert alert-danger') }}

    <p>Review the settings you have made. If something is wrong, please go back and change it.</p>

    <div class="row">
        <div class="col-md-6">
            <h3>General</h3>

            {% if cache_write %}
                <i class="fa fa-check fa-lg" style="color: #46a546"></i>
            {% else %}
                <i class="fa fa-times fa-lg" style="color: #e9322d"></i>
            {% endif %}
            {{ cache_dir }}

            <p>
                <i class="fa fa-check fa-lg" style="color: #46a546"></i> Database
            </p>

            <p><strong>Page Title:</strong> {{ title }}</p>

            <p><strong>Admin Email:</strong> {{ adminemail }}</p>

            <h3>Date & Time</h3>

            <p><strong>Timezone:</strong> {{ timezone }}</p>

            <p><strong>Time Format:</strong> {{ time_format }}</p>
        </div>
        <div class="col-md-6">
            <h3>Plugin</h3>

            <p>
                {% if welcome_msg %}
                    <i class="fa fa-check fa-lg" style="color: #46a546"></i>
                {% else %}
                    <i class="fa fa-times fa-lg" style="color: #e9322d"></i>
                {% endif %}
                Show welcome message
            </p>

            <p>
                {% if welcome_first_msg %}
                    <i class="fa fa-check fa-lg" style="color: #46a546"></i>
                {% else %}
                    <i class="fa fa-times fa-lg" style="color: #e9322d"></i>
                {% endif %}
                Show first welcome message
            </p>

            <p><strong>Database sync:</strong> every {{ ping }} seconds</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="?step=three" class="btn btn-default">Back</a>
            <button type="submit" name="check_submit" value="1" class="btn btn-primary">
                Next
            </button>
        </div>
    </div>
</form>