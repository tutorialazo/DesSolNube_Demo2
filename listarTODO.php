<?php
include('conexion.php'); 

$db = conexion();

if (!$db) {
    die("Error: No se pudo conectar a la base de datos.");
}

$query = "SELECT * FROM persona";
$result = pg_query($db, $query);

if (!$result) {
    echo "Error al realizar la consulta.";
} else {
    echo "<h1>Lista de Personas</h1>";
    echo "<table class='table table-bordered'>";
    echo "<thead>";
    echo "<tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Celular</th>
          </tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['idpersona'] . "</td>";
        echo "<td>" . $row['documento'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellido'] . "</td>";
        echo "<td>" . $row['direccion'] . "</td>";
        echo "<td>" . $row['celular'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

pg_close($db);  
?>
