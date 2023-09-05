<?php

	function conexion(){

	$host = "host=containers-us-west-173.railway.app";
	$port = "port=6928";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "password=dS8fvl7EvlUbyCUI9oaH";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>