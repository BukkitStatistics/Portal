<div class="row-fluid">
    <div class="span12">
        <div class="page-header">
            <h1>
                <i class="icon-cogs icon-large"></i> Admin Panel
                <small>Configuration for the web portal and plugin.</small>
            </h1>
        </div>
        <?php if(fRequest::isPost() && !fMessaging::check('input', 'admin')): ?>
            <div class="alert alert-block alert-success">
                <p>
                    <strong>Success!</strong> Data successfully stored in the database.
                </p>
            </div>
        <?php endif; ?>
        <?php Util::showMessages('input', 'admin', 'alert alert-block alert-danger'); ?>
    </div>
</div>
<form method="post" name="settings" id="settings" class="form-setup">
    <?php if($this->get('sub')): ?>
        <?php $this->place('sub'); ?>
    <?php else: ?>
        <div class="row-fluid">
            <a href="?page=admin&sub=general" class="span2 offset3 well well-small force-center">
                <h2><i class="icon-user icon-3x"></i></h2>
                <h3>General</h3>
            </a>
            <a href="?page=admin&sub=portal" class="span2 well well-small force-center">
                <h2><i class="icon-pencil icon-3x"></i></h2>
                <h3>Portal</h3>
            </a>
            <a href="?page=admin&sub=database" class="span2 well well-small force-center">
                <h2><i class="icon-cog icon-3x"></i></h2>
                <h3>Database</h3>
            </a>
        </div>
        <div class="row-fluid">
            <a href="?page=admin&sub=messages" class="span2 offset4 well well-small force-center">
                <h2><i class="icon-comment icon-3x"></i></h2>

                <h3>Messages</h3>
            </a>
            <a href="?page=admin&sub=modules" class="span2 well well-small force-center">
                <h2><i class="icon-tasks icon-3x"></i></h2>

                <h3>Modules</h3>
            </a>
        </div>
    <?php endif; ?>
<div class="row-fluid">
    <div class="span12">
        <div class="form-actions">
            <div class="pull-left">
                <?php if($this->get('sub')): ?>
                    <button class="btn btn-large btn-primary" name="save" value="true" id="Save">
                        <i class="icon-save"></i> Save
                    </button>
                    <a href="?page=admin" class="btn btn-large">
                        <i class="icon-reply"></i> Back
                    </a>
                <?php endif; ?>
            </div>
            <div class="pull-right">
                <button class="btn btn-large btn-danger" name="logout" value="true">
                    <i class="icon-signout"></i> Logout
                </button>
                <a href="./" class="btn btn-large">
                    <i class="icon-home"></i> Home
                </a>
            </div>
        </div>
    </div>
</div>
</form>