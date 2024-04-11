<?php
	function conexion(){

	$host = "monorail.proxy.rlwy.net";
	$port = "port=47760";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "JXBDNUAXDEitXULmBlnqrAzGTnKYOJrI";

	$db = pg_connect("$host $port $dbname $user $password");

	if (!$db) {
    	die("Error al conectar con PostgreSQL: " . pg_last_error());
	}

	return $db;
}
?>
