<?php
	function conexion(){

	$host = "host=monorail.proxy.rlwy.net";
	$port = "port=21925";
	$dbname = "dbname=Postgres";
	$user = "user=postgres";
	$password = "password=YdeeqpIGHxnFVEurKSncMEaXGpAzlHPY";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>
