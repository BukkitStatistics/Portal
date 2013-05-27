<div class="row-fluid">
    <div class="span5 offset4 well">
        <h1 class="form-signin-heading">Reset password</h1>
        {{ Util.showMessages('*', 'reset', 'alert alert-danger') }}
        <form action="" method="post" name="login" id="login" class="form-login">
            <fieldset>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input type="email" placeholder="E-Mail" name="email" value="{{ email }}"/>
                </div>
            </fieldset>
            <div class="form-actions">
                <button class="btn btn-large btn-primary" name="send_pw" value="true" id="send_pw">
                    <i class="icon-envelope"></i> Send
                </button>
                <a href="?page=login" class="btn btn-large"><i class="icon-reply"></i> Back</a>
            </div>
        </form>
    </div>
</div>