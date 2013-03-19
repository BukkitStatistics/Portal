<?php
include("../include/config/config.php");

if(SETUP_COMPLETE) {

	include("../include/security/init.php");
	include("../include/security/secure.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Settings</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="../../../media/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../media/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="../../../media/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../../media/css/yasp.css" rel="stylesheet">

	<!--[if lt IE 9]>
    <script src="../../../src/js/html5.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container page-width force-center">

<div class="row-fluid">
	<div class="span10 offset2">
		<a href=""><img src="../../../media/img/plugin_logo.png" /></a>
	</div>
</div>

<form action="" method="post" name="settings" id="settings" class="form-setup">

<?php

if (!isset($_POST["Save"])) {
	$username = CONFIG_USER;
	$password = CONFIG_PASS;
	
	$servername = SERVER_NAME;
	$logourl = LOGO_URL;
	
	$dbhost = DB_SERVER;
	$dbuser = DB_USER;
	$dbpass = DB_PASSWORD;
	$dbname = DB_NAME;
	$dbport = DB_PORT;
} else {
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$servername = $_POST["servername"];
	$logourl = $_POST["logourl"];
	
	$dbhost = $_POST["dbhost"];
	$dbuser = $_POST["dbuser"];
	$dbpass = $_POST["dbpass"];
	$dbname = $_POST["dbname"];
	$dbport = $_POST["dbport"];
	
	$link = @mysql_connect($dbhost.":".$dbport, $dbuser, $dbpass);
	if ($link) {
		$db_selected = @mysql_select_db($dbname, $link);
		if ($db_selected) {
			echo "<div class='alert alert-success'>";
			echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			echo "<strong>Success!</strong> Data saved successfully.";
			echo "</div>";
			$saveFile = true;
			
			$string = '<?php
    define("SETUP_COMPLETE", true);
    
    define("CONFIG_USER", "'.$username.'");
    define("CONFIG_PASS", "'.$password.'");
    
    define("SERVER_NAME", "'.$servername.'");
    define("LOGO_URL", "'.$logourl.'");
    
    define("DB_SERVER"  , "'.$dbhost.'");
    define("DB_USER"    , "'.$dbuser.'");
    define("DB_PASSWORD", "'.$dbpass.'");
    define("DB_NAME"    , "'.$dbname.'");
    define("DB_PORT"    , "'.$dbport.'");

    define("CLOCK24", true); // true = 24 hours; false = 12 hours

    define("USE_MEGAMETERS", true);
    define("LOCALE", "en");
    define("TIMEZONE", "");
?>';
		
			$fp = fopen("../include/config/config.php", "w");
			fwrite($fp, $string);
			fclose($fp);
		} else {
			echo "<div class='alert alert-error'>";
			echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			echo "<strong>Error!</strong> The database does not exist, or the user does not have the permission to connect to it";
			echo "</div>";
		}
	} else {
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		echo "<strong>Error!</strong> Could not establish connection to the database. Check the credentials!";
		echo "</div>";
	}	
}

?>

<div class="row-fluid">
	<div class="span2" style="text-align:center;">
		<h2><i class="icon-user icon-3x" style="color:#ccc;"></i></h2>
	</div>
	<div class="span10 well">
		<div class="row-fluid">
			<div class="span6">
				<fieldset>
				<label><strong>Username</strong></label>
				<input type="text" name="username" id="username" class="input-block-level" <?php echo 'value="'.$username.'"'; ?> />
				</fieldset>
			</div>
			<div class="span6">
				<fieldset>
				<label><strong>Password</strong></label>
				<input type="password" name="password" id="password" class="input-block-level" <?php echo 'value="'.$password.'"'; ?> />
				</fieldset>
			</div>
		</div>
        </div>
</div>

<div class="row-fluid">
	<div class="span2" style="text-align:center;">
		<h2><i class="icon-pencil icon-3x" style="color:#ccc;"></i></h2>
	</div>
	<div class="span10 well">  
		<div class="row-fluid">
			<div class="span6">
				<fieldset>
				<label><strong>Server name</strong></label>
				<input type="text" name="servername" id="servername" class="input-block-level" <?php echo 'value="'.$servername.'"'; ?> />
				</fieldset> 
			</div>
			<div class="span6">
				<fieldset>
				<label><strong>Logo URL</strong></label>
				<input type="text" name="logourl" id="logourl" class="input-block-level" <?php echo 'value="'.$logourl.'"'; ?> />
				</fieldset> 
			</div>
		</div>  
        </div>
</div>

<div class="row-fluid">
	<div class="span2" style="text-align:center;">
		<h2><i class="icon-cog icon-3x" style="color:#ccc;"></i></h2>
	</div>
	<div class="span10 well">
		<div class="row-fluid">
			<div class="span6">
				<div class="row-fluid">
				<div class="span8">
				<fieldset>
				<label><strong>Database Host</strong></label>
				<input type="text" name="dbhost" id="dbhost" class="input-block-level" value="<?php echo $dbhost; ?>" />
				</fieldset>
				</div>
				<div class="span4">
				<fieldset>
				<label><strong>Port</strong></label>
				<input type="text" name="dbport" id="dbport" class="input-block-level" value="3306" value="<?php echo $dbport; ?>" />
				</fieldset>
				</div>
				</div>
				<fieldset>
				<label><strong>Database Username</strong></label>
				<input type="text" name="dbuser" id="dbuser" class="input-block-level" value="<?php echo $dbuser; ?>" />
				</fieldset> 
			</div>
			<div class="span6">
				<fieldset>
				<label><strong>Database Name</strong></label>
				<input type="text" name="dbname" id="dbname" class="input-block-level" value="<?php echo $dbname; ?>" />
				<label><strong>Database Password</strong></label>
				<input type="password" name="dbpass" id="dbpass" class="input-block-level" value="<?php echo $dbpass; ?>" />
				</fieldset> 
				</fieldset> 
			</div>
		</div> 
       	</div>
</div>

<div class="row-fluid">
<div class="span10 offset2">
<div class="pull-left"><button class="btn btn-large btn-primary" name="Save" id="Save"><i class="icon-save"></i> Save</button></div>
<div class="pull-right"><a href="" class="btn btn-large"><i class="icon-home"></i> Home</a></div>
</div>

</form>

</div>

<script src="../../../src/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../../../src/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>