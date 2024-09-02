<?php
// Incluir la función de conexión
include 'conexion.php';

// Conectar a la base de datos
$db = conexion();

// Obtener la lista de entidades
$sql = "SELECT id, nombre FROM entidades"; // Cambia 'entidades' y 'nombre' según tu esquema
$result = pg_query($db, $sql);

if (!$result) {
    die("Error en la consulta: " . pg_last_error($db));
}

$entidades = pg_fetch_all($result);

// Manejar la selección y actualización
$selectedId = $_GET['id'] ?? null;
$entity = null;

if ($selectedId) {
    // Obtener los datos de la entidad seleccionada
    $sql = "SELECT * FROM entidades WHERE id = $1"; // Cambia 'entidades' y los campos según tu esquema
    $result = pg_query_params($db, $sql, [$selectedId]);

    if (!$result) {
        die("Error en la consulta: " . pg_last_error($db));
    }

    $entity = pg_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        
        // Actualizar la entidad
        $sql = "UPDATE entidades SET nombre = $1 WHERE id = $2"; // Cambia según tu esquema
        $result = pg_query_params($db, $sql, [$nombre, $selectedId]);

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
    <title>Editar Entidad</title>
</head>
<body>
    <h1>Editar Entidad</h1>

    <form method="GET" action="editar.php">
        <label for="id">Seleccionar entidad:</label>
        <select name="id" id="id" onchange="this.form.submit()">
            <option value="">Seleccionar...</option>
            <?php foreach ($entidades as $entidad): ?>
                <option value="<?= htmlspecialchars($entidad['id']) ?>" <?= $selectedId == $entidad['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($entidad['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($entity): ?>
        <h2>Formulario de Edición</h2>
        <form method="POST" action="editar.php?id=<?= htmlspecialchars($selectedId) ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($entity['nombre']) ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    <?php endif; ?>
</body>
</html>
