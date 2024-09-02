<?php
// Incluir la función de conexión
include 'conexion.php';

// Conectar a la base de datos
$db = conexion();

// Obtener la lista de personas
$sql = "SELECT idpersona, nombre FROM persona"; // Cambiado a la tabla 'persona'
$result = pg_query($db, $sql);

if (!$result) {
    die("Error en la consulta: " . pg_last_error($db));
}

$personas = pg_fetch_all($result);

// Manejar la selección y actualización
$selectedId = $_GET['id'] ?? null;
$persona = null;

if ($selectedId) {
    // Obtener los datos de la persona seleccionada
    $sql = "SELECT * FROM persona WHERE idpersona = $1"; // Cambiado a la tabla 'persona'
    $result = pg_query_params($db, $sql, [$selectedId]);

    if (!$result) {
        die("Error en la consulta: " . pg_last_error($db));
    }

    $persona = pg_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $documento = $_POST['documento'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $celular = $_POST['celular'];
        
        // Actualizar la persona
        $sql = "UPDATE persona SET documento = $1, nombre = $2, apellido = $3, direccion = $4, celular = $5 WHERE idpersona = $6"; // Cambiado a la tabla 'persona'
        $result = pg_query_params($db, $sql, [$documento, $nombre, $apellido, $direccion, $celular, $selectedId]);

        if (!$result) {
            die("Error en la consulta: " . pg_last_error($db));
        }

        // Redirigir o mostrar mensaje de éxito
        header('Location: editar.php'); // Redirige a la página principal o a una página de confirmación
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
</head>
<body>
    <h1>Editar Persona</h1>

    <form method="GET" action="editar.php">
        <label for="id">Seleccionar persona:</label>
        <select name="id" id="id" onchange="this.form.submit()">
            <option value="">Seleccionar...</option>
            <?php foreach ($personas as $personaItem): ?>
                <option value="<?= htmlspecialchars($personaItem['idpersona']) ?>" <?= $selectedId == $personaItem['idpersona'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($personaItem['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($persona): ?>
        <h2>Formulario de Edición</h2>
        <form method="POST" action="editar.php?id=<?= htmlspecialchars($selectedId) ?>">
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" value="<?= htmlspecialchars($persona['documento']) ?>" required>
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($persona['nombre']) ?>" required>
            <br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($persona['apellido']) ?>" required>
            <br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($persona['direccion']) ?>" required>
            <br>
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" value="<?= htmlspecialchars($persona['celular']) ?>" required>
            <br>
            <button type="submit">Actualizar</button>
        </form>
    <?php endif; ?>
</body>
</html>
