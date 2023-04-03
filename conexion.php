<?php

	function conexion(){

	$host = "host=xxxx";
	$port = "port=xxxx";
	$dbname = "dbname=xxxx";
	$user = "user=xxxx";
	$password = "password=xxxx";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>