<?php
include("../yasp/config/config.php");
include("../yasp/security/login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Log in</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="../src/css/bootstrap.min.css" rel="stylesheet">
	<link href="../src/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="../src/css/font-awesome.min.css" rel="stylesheet">
	<link href="./src/css/yasp.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="../src/js/html5.min.js"></script>
	<![endif]-->
</head>
<body>

<?php

if (isset($_GET['origin'])) { $origin = $_GET['origin']; }
else { $origin = ""; }

?>

<div class="container page-width force-center" style="padding-top: 150px;">
<div class="row">
<div class="span4 offset4 well">

<form action="" method="post" name="login" id="login" class="form-login">
	<h2 class="form-signin-heading">Secure Area</h2>
	<input type="hidden" name="origin" value="<?php echo $origin; ?>" />
	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
		<input type="text" class="input-block-level" placeholder="Username" name="cuser" style="width: 90%;" />
	</div>
	
	<div class="input-prepend">
      		<span class="add-on"><i class="icon-key"></i></span>
		<input type="password" class="input-block-level" placeholder="Password" name="cpass" style="width: 90%;" />
	</div>
	<button class="btn btn-large btn-primary" name="signin" id="signin">Sign in</button>
</form>

</div>
</div>
</div>

<script src="../src/js/jq.js" type="text/javascript"></script>
<script src="../src/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>