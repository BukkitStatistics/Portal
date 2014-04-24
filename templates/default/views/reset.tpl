<div class="row">
    <div class="col-md-5 offset4 well">
        <h1 class="form-signin-heading">Reset password</h1>
        {{ Util.showMessages('*', 'reset', 'alert alert-danger') }}
        <form action="" method="post" name="login" id="login" class="form-login">
            <fieldset>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" placeholder="E-Mail" name="email" value="{{ email }}"/>
                </div>
            </fieldset>
            <div class="form-actions">
                <button class="btn btn-lg btn-primary" name="send_pw" value="true" id="send_pw">
                    <i class="fa fa-envelope"></i> Send
                </button>
                <a href="?page=login" class="btn btn-lg"><i class="fa fa-reply"></i> Back</a>
            </div>
        </form>
    </div>
</div>