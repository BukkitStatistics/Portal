<?php

class YASP {
	private $sql_connection;
	private $_ObjServer;
	
	function __construct() {$this->secureGlobals();	
		@$sql_connection = mysql_connect(DB_SERVER . ':' . DB_PORT,DB_USER,DB_PASSWORD) or die("YASP-WEB could not acquire connection to Database");
		@mysql_select_db(DB_NAME) or die("YASP-WEB connected to SQL server, but could not select the database");
		$this->setTimeZone();
		$this->_ObjServer = new SERVER();
	}
	
	function __destruct() { @mysql_close(); }
	
	private function secureSuperGlobalGET(&$value, $key) {
		$_GET[$key] = htmlspecialchars(stripslashes($_GET[$key]));
		$_GET[$key] = str_ireplace("script", "blocked", $_GET[$key]);
		$_GET[$key] = mysql_escape_string($_GET[$key]);
		return $_GET[$key];
	}
	
	private function secureSuperGlobalPOST(&$value, $key) {
		$_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
		$_POST[$key] = str_ireplace("script", "blocked", $_POST[$key]);
		$_POST[$key] = mysql_escape_string($_POST[$key]);
		return $_POST[$key];
	}
	
	private function secureGlobals() {
		array_walk($_GET, array($this, 'secureSuperGlobalGET'));
		array_walk($_POST, array($this, 'secureSuperGlobalPOST'));
	}
	
	private function setTimeZone() {
		if(phpversion() >= '5.1.0' && TIMEZONE != '')
		date_default_timezone_set(TIMEZONE);
	}
	
	public function getServer() {
		return $this->_ObjServer;
	}
	
	public function getDatabaseVersion() {
		$row = mysql_fetch_assoc(mysql_query("SELECT * FROM config"));
		return $row['dbVersion'];
	}
}

?>