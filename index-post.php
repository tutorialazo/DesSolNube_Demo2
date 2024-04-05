<?php
include("conexion.php");
$con = conexion();

$doc = $_POST["doc"];
$nom = $_POST["nom"];
$ape = $_POST["ape"];
$dir = $_POST["dir"];
$cel = $_POST["cel"];

$doc = pg_escape_string($doc);
$nom = pg_escape_string($nom);
$ape = pg_escape_string($ape);
$dir = pg_escape_string($dir);
$cel = pg_escape_string($cel);

$sql = "insert into persona values(default,'$doc','$nom','$ape','$dir','$cel')";
pg_query($con, $sql);

header("location:index.php");
?>