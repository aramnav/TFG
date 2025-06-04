<?php
session_start();
$tiempo_inactividad = 600; // 30 minutos en segundos
require 'const/conexion.php';


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $tiempo_inactividad) {
    session_unset();
    session_destroy();
    header("Location: login.php?expirada=1");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Actualiza el tiempo de última actividad

$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/usuario/" . $_SESSION["usuario"]["id_usuario"];
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_usuario = json_decode($respuesta, true);
if (!$json_usuario) {
    session_destroy();
    die("ERROR 1");
}
if (isset($json_usuario["error"])) {
    session_destroy();
    die("ERROR 2");
}

if (isset($json_usuario["mensaje"])) {
    session_destroy();
    die("ERROR 3");
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Hijo</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>
    .sidebar {
        min-height: 100vh;
        background-color: #12578e;
        color: white;
    }

    .sidebar .nav-link {
        color: white;
        font-weight: 500;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #0e456f;
        color: #fff;
    }

    .content {
        padding: 2rem;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .table-actions button {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .sidebar {
            min-height: auto;
        }
    }
</style>

<body>
    <?php require 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-3 col-lg-2 d-md-block sidebar py-4 px-3">
                <h4 class="text-center mb-4">PADRE</h4>
                <div class="nav flex-column">
                    <a href="#" class="nav-link active">Usuarios</a>
                    <a href="#" class="nav-link">Niños</a>
                    <a href="#" class="nav-link">Padres</a>
                    <a href="#" class="nav-link">Educadores</a>
                    <a href="#" class="nav-link">Aulas</a>
                    <a href="#" class="nav-link">Matriculas</a>
                    <a href="#" class="nav-link">Eventos</a>
                    <a href="#" class="nav-link">Mensajes</a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 content">
                <h2>Gestión de Usuarios</h2>

                <div class="mb-3 text-end">
                    <button class="btn btn-success">+ Añadir nuevo</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>admin@ejemplo.com</td>
                                <td>123456789</td>
                                <td>Administrador</td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-primary">Editar</button>
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </td>
                            </tr>
                            <!-- Más filas -->

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php require 'footer.php'; ?>
</body>

</html>