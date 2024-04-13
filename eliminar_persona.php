<?php
include("conexion.php");
$con = conexion();
$documento = $_GET['documento']; 
$sql = "DELETE FROM persona WHERE documento = '$documento'"; 
pg_query($con, $sql);
header("location:listar_grupoYCG.php");
?>
