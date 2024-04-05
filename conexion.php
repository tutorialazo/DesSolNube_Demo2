<?php
	function conexion(){

	$host = "host=monorail.proxy.rlwy.net";
	$port = "port=22301";
	$dbname = "dbname=railway";
	$user = "user=postgres";
	$password = "password=wAVMkgugRabZehMCDyvCykUYtdpTpbPe";

	$cadena = "$host $port $dbname $user $password";

	$db = pg_connect($cadena);

	return $db;
}
?>