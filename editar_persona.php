<?php
include("conexion.php");
$con = conexion();
$documento = $_GET['documento']; // Obtener el número de documento desde el parámetro GET
$sql = "SELECT * FROM persona WHERE documento = '$documento'"; // Buscar el registro por número de documento
$resultado = pg_query($con, $sql);
$fila = pg_fetch_assoc($resultado);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí deberías obtener los datos del formulario y realizar la actualización en la base de datos
    $doc = $_POST["doc"];
    $nom = $_POST["nom"];
    $ape = $_POST["ape"];
    $dir = $_POST["dir"];
    $cel = $_POST["cel"];
    $sql = "UPDATE persona SET documento='$doc', nombre='$nom', apellido='$ape', direccion='$dir', celular='$cel' WHERE documento='$documento'"; // Actualizar el registro por número de documento
    pg_query($con, $sql);
    header("location:listar_grupoYCG.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Persona</title>
    <!-- Tu código de estilos CSS -->
</head>
<body>
    <!-- Formulario de edición -->
    <div class="container">
        <h2>Editar Persona</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Campos del formulario -->
            <input type="text" name="doc" value="<?php echo $fila['documento']; ?>">
            <input type="text" name="nom" value="<?php echo $fila['nombre']; ?>">
            <input type="text" name="ape" value="<?php echo $fila['apellido']; ?>">
            <input type="text" name="dir" value="<?php echo $fila['direccion']; ?>">
            <input type="text" name="cel" value="<?php echo $fila['celular']; ?>">
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
