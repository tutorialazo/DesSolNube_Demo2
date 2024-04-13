<?php
include("conexion.php");
$con = conexion();
$id = $_GET['id'];
$sql = "SELECT * FROM persona WHERE id = $id";
$resultado = pg_query($con, $sql);
$fila = pg_fetch_assoc($resultado);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí deberías obtener los datos del formulario y realizar la actualización en la base de datos
    $doc = $_POST["doc"];
    $nom = $_POST["nom"];
    $ape = $_POST["ape"];
    $dir = $_POST["dir"];
    $cel = $_POST["cel"];
    $sql = "UPDATE persona SET documento='$doc', nombre='$nom', apellido='$ape', direccion='$dir', celular='$cel' WHERE id=$id";
    pg_query($con, $sql);
    header("location:listar_grupoYCG.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Pagina Principal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
        h1 {
            font-weight: bold;
            color: #333;
        }

        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand img {
            width: 30px;
            position: absolute;
            margin-left: -35px;
        }

        .navbar-brand span {
            position: relative;
            left: 35px;
        }

        .nav-link {
            color: #333 !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ff6b6b !important;
        }

        .btn-info {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .btn-info:hover {
            background-color: #ff4f4f;
            border-color: #ff4f4f;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 50px;
        }

        footer img {
            margin-bottom: 10px;
        }
    </style>
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
