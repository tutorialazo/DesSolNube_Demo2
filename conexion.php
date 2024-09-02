<?php
	function conexion(){

	$host = "host=dpg-cr6fvvrv2p9s7392u5e0-a.oregon-postgres.render.com";
	$port = "port=5432";
	$dbname = "dbname=dbclase_35t5";
	$user = "user=dbclase_35t5_user";
	$password = "password=BT22FNp4dr5kRLgBrL8LJ8yLbJXUfWd8";

	$db = pg_connect("$host $port $dbname $user $password");

	return $db;
}
?>
