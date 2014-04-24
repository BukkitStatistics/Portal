{% if checkMessage('slug', 'admin/multi') %}
    {{ Util.showMessages('slug', 'admin/multi', 'alert alert-danger') }}
{% else %}
    {{ Util.showMessages('file', 'admin/multi', 'alert alert-danger') }}
    <div class="row">
        <div class="col-md-6">
            <label for="server_name"><strong>Server name</strong></label>
            <input type="text" name="server_name" id="server_name" class="form-control"
                   value="{{ server_name }}"/>
        </div>
        <div class="col-md-6">
            <strong>Server slug:</strong>
            <input type="text" name="server_slug" id="server_slug" class="form-control"
                   value="{{ server_slug }}"
                    {% if action == 'edit' %} disabled="disabled" {% endif %}/>
        </div>
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
            <div class="row">
                <div class="col-md-12">
                    <label for="db_user"><strong>Database Username</strong></label>
                    <input type="text" name="db_user" id="db_user" class="form-control"
                           value="{{ db_user }}"/>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-12">
                    <label for="db_pw"><strong>Database Password</strong></label>
                    <input type="text" name="db_pw" id="db_pw" class="form-control"
                           value="{{ db_pw }}"/>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="save_server" value="1"/>
    {% if action == 'add' %}
        <script type="text/javascript">
            $(document).ready(function () {
                $('#server_name').keyup(function () {
                    $('#server_slug').val(string_to_slug($(this).val(), '_'));
                });
            });
        </script>
    {% endif %}
{% endif %}