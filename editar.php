<?php
// Conectar a la base de datos
$host = 'localhost';
$db = 'nombre_de_la_base_de_datos';
$user = 'usuario';
$pass = 'contraseña';

$pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obtener la lista de entidades
$sql = "SELECT id, nombre FROM entidades"; // Cambia 'entidades' y 'nombre' según tu esquema
$stmt = $pdo->query($sql);
$entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Manejar la selección y actualización
$selectedId = $_GET['id'] ?? null;
$entity = null;

if ($selectedId) {
    $sql = "SELECT * FROM entidades WHERE id = :id"; // Cambia 'entidades' y los campos según tu esquema
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $selectedId]);
    $entity = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        // Actualizar la entidad
        $sql = "UPDATE entidades SET nombre = :nombre WHERE id = :id"; // Cambia según tu esquema
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre, 'id' => $selectedId]);

        // Redirigir o mostrar mensaje de éxito
        header('Location: listar.php'); // Redirige a la página principal o a una página de confirmación
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
