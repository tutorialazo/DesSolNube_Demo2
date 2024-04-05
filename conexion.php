<?php
	function conexion(){

	$host = "host=monorail.proxy.rlwy.net";
	$port = "port=22301";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "password=wAVMkgugRabZehMCDyvCykUYtdpTpbPe";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>