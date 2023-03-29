<?php

	function conexion(){

	$host = "host=containers-us-west-159.railway.app";
	$port = "port=7293";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "password=U9Vs8MGbpkJFVpbWkrSC";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>