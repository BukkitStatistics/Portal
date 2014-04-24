<div class="row">
    <div class="col-md-12 well">
        {% if main %}
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p>
                            <span class="label label-info"><strong>Info</strong></span> Here you can set up multiple
                            config
                            files
                            for different servers. With this you can use one portal installation with more than one
                            server.<br>
                            <strong>The database credentials specified in the database section are used for the main
                                portal.</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {% if servers %}
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 12%">Slug</th>
                                <th style="width: 35%">Server name</th>
                                <th style="width: 20%">Database name</th>
                                <th style="width: 25%">Database host</th>
                                <th style="width: 8%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {% for server in servers if server.db_values is not null %}
                                <tr>
                                    <td>{{ server.slug }}</td>
                                    <td>{{ server.name }}</td>
                                    <td>{{ server.db_values.database }}</td>
                                    <td>{{ server.db_values.host }}:{{ server.db_values.port }}</td>
                                    <td>
                                        <a href="?page=admin&sub=multi&action=edit&slug={{ server.slug }}">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        &nbsp;
                                        <a href="?page=admin&sub=multi&action=delete&slug={{ server.slug }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
                        </table>
                    {% else %}
                        <p class="text-muted">No servers specified.</p>
                    {% endif %}
                    <div class="form-actions">
                        <a href="?page=admin&sub=multi&action=add" class="btn btn-primary">Add Server</a>
                    </div>
                </div>
            </div>
        {% else %}
            {% include multi_form %}
            <br>
            <a href="?page=admin&sub=multi" class="btn btn-default btn-block">Back to servers</a>
        {% endif %}
    </div>
</div>