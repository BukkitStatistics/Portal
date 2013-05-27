<div class="row-fluid">
    <div class="span5 offset4 well">
        <h1 class="form-signin-heading">Secure Area</h1>
        {{ Util.showMessages('*', 'login', 'alert alert-danger') }}
        <form action="" method="post" name="login" id="login" class="form-login">
            <fieldset>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input type="email" placeholder="E-Mail" name="email" value="{{ email }}"/>
                </div>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-key"></i></span>
                    <input type="password" placeholder="Password" name="pw"/>
                </div>
                <label class="checkbox" for="keep_login">
                    <input type="hidden" name="keep_login" value="0"/>
                    <input type="checkbox" value="1" name="keep_login" id="keep_login"> Remember me
                </label>
                <a href="?page=reset">Reset password</a>
            </fieldset>
            <div class="form-actions">
                <button class="btn btn-large btn-primary" name="signin" value="true" id="signin">
                    <i class="icon-signin"></i> Sign in
                </button>
            </div>
        </form>
    </div>
</div>