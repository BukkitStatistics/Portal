{% if type == 'critical' %}
    <div class="alert alert-danger alert-block">
        <h3>Sorry. An unexpected error occurred.</h3>

        <p>{{ e_message }}</p>

        <p><strong>Type:</strong> {{ e_name }}</p>
        <strong>File:</strong> {{ e_file }}:{{ e_line }}
        <br><br>
        <pre>{{ e_backtrace }}</pre>
    </div>
{% elseif type == 'error' %}
    <div class="alert alert-block">
        <h3><?php echo fText::compose('Sorry. An error occurred.') ?></h3>

        <p>{{ e_message }}</p>
    </div>
{% elseif type == '404' %}
    <div class="alert alert-block">
        <h3>404 - Page not found.</h3>

        <p>The page you are trying to access does not exist.</p>
    </div>
{% else %}
    <div class="alert alert-info alert-block">
        <h3>Sorry. An error occurred.</h3>

        <p>Please try again later.</p>
    </div>
{% endif %}