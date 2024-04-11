<?php
	function conexion(){

	$host = "host=monorail.proxy.rlwy.net";
	$port = "port=41590";
	$dbname = "dbname=Postgres";
	$user = "user=postgres";
	$password = "oYoVgzNsOBPQiALcvuRugAtxyRVDSVSR";

	$db = pg_connect=("$host $port $dbname $user $password");

	return $db;
}
?>
