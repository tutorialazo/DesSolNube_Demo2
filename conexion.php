<?php
	function conexion(){

	$host = "monorail.proxy.rlwy.net";
	$port = "port=47760";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "JXBDNUAXDEitXULmBlnqrAzGTnKYOJrI";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>
