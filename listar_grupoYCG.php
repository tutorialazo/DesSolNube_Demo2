<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listado</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
</head>
<body>

    <!-- Contenido de tu página -->
    <div class="container">
        <h2>Listado de Personas Registradas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th> <!-- Agrega la columna del ID -->
                    <th>Nro Documento</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Acciones</th> <!-- Nueva columna para botones de acción -->
                </tr>
            </thead>
            <tbody>
                <?php
                include("conexion.php");
                $con = conexion();
                $sql = "SELECT * FROM persona";
                $resultado = pg_query($con, $sql);
                
                // Verificar si se obtuvieron resultados
                if ($resultado) {
                    // Recorre los resultados de la consulta y muestra cada fila en la tabla
                    while ($fila = pg_fetch_assoc($resultado)) {
                        echo "<tr>";
                        // Verificar si el campo 'id' está presente en la fila antes de mostrarlo
                        if (isset($fila['id'])) {
                            echo "<td>" . $fila['id'] . "</td>"; // Muestra el ID en la tabla
                        } else {
                            echo "<td>No disponible</td>"; // Mostrar un mensaje si el ID no está disponible
                        }
                        echo "<td>" . $fila['documento'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['apellido'] . "</td>";
                        echo "<td>" . $fila['direccion'] . "</td>";
                        echo "<td>" . $fila['celular'] . "</td>";
                        // Agrega botones de edición y eliminación
                        echo "<td>
                                <a href='editar_persona.php?id=" . $fila['id'] . "' class='btn btn-primary'>Editar</a>
                                <a href='eliminar_persona.php?id=" . $fila['id'] . "' class='btn btn-danger'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1
