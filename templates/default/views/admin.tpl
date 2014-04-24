<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <i class="fa fa-cogs fa-lg"></i> Admin Panel
                <small>Configuration for the web portal and plugin.</small>
            </h1>
        </div>
        {% if staticCall('fRequest', 'isPost') and not checkMessage('input', 'admin') %}
            <div class="alert alert-success">
                <p>
                    <strong>Success!</strong> Operation successfully executed.
                </p>
            </div>
        {% endif %}
        {{ Util.showMessages('input', 'admin', 'alert alert-block alert-danger') }}
    </div>
</div>
<form method="post" name="settings" id="settings" class="form-setup">
    <div class="row">
        <div class="col-md-3">
            {% include 'admin/navi.tpl' %}
        </div>
        <div class="col-md-9">
            {% include sub ignore missing %}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-actions">
                <div class="pull-left">
                    {% if sub and not main %}
                        <button class="btn btn-lg btn-primary" name="save" value="true" id="Save">
                            <i class="fa fa-save"></i> Save
                        </button>
                    {% endif %}
                </div>
                <div class="pull-right">
                    <button class="btn btn-lg btn-danger" name="logout" value="true">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                    <a href="./" class="btn btn-lg">
                        <i class="fa fa-home"></i> Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>