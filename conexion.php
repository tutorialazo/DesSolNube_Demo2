<?php
	function conexion(){

	$host = "monorail.proxy.rlwy.net";
	$port = "22301";
	$dbname = "railway";
	$user = "postgres";
	$password = "wAVMkgugRabZehMCDyvCykUYtdpTpbPe";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>