<?php
	function conexion(){

	$host = "host=monorail.proxy.rlwy.net";
	$port = "port=43382";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "password=XCEOokvyFjLvJoCWAxDkpnLgbRNihnRl";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>
