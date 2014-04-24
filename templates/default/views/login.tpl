<div class="row">
    <div class="col-md-5 col-md-offset-4 well">
        <h1 class="form-signin-heading">Secure Area</h1>
        {{ Util.showMessages('*', 'login', 'alert alert-danger') }}
        <form action="" method="post" class="form-horizontal" role="form" name="login" id="login">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="{{ email }}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="pw" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="keep_login" value="0"/>
                            <input type="checkbox" value="1" name="keep_login" id="keep_login"> Remember me
                        </label>
                    </div>
                    <a href="?page=reset">Reset password</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-lg btn-primary" name="signin" value="true" id="signin">
                        <i class="fa fa-signin"></i> Sign in
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>