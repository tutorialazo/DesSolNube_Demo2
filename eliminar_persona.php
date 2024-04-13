<?php
include("conexion.php");
$con = conexion();
$id = $_GET['id'];
$sql = "DELETE FROM persona WHERE id = $id";
pg_query($con, $sql);
header("location:listar_grupoYCG.php");
?>
