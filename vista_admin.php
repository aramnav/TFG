<?php
session_start();
$tiempo_inactividad = 600; // 30 minutos en segundos
require 'const/conexion.php';

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $tiempo_inactividad) {
    session_unset();
    session_destroy();
    header("Location: login.php?expirada=1");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Actualiza el tiempo de última actividad

//OBTENER USUARIOS
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/administradores";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_administradores = json_decode($respuesta, true);
$administradores = $json_administradores["administradores"];



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
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
                <h4 class="text-center mb-4">Admin</h4>
                <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="usuarios-tab" data-bs-toggle="pill" href="#usuarios" role="tab">Usuarios</a>
                    <a class="nav-link" id="ninos-tab" data-bs-toggle="pill" href="#ninos" role="tab">Niños</a>
                    <a class="nav-link" id="padres-tab" data-bs-toggle="pill" href="#padres" role="tab">Padres</a>
                    <a class="nav-link" id="profesores-tab" data-bs-toggle="pill" href="#profesores" role="tab">Profesores</a>
                    <a class="nav-link" id="aulas-tab" data-bs-toggle="pill" href="#aulas" role="tab">Aulas</a>
                    <a class="nav-link" id="clientes-tab" data-bs-toggle="pill" href="#clientes" role="tab">Clientes</a>
                    <a class="nav-link" id="guarderias-tab" data-bs-toggle="pill" href="#guarderias" role="tab">Guarderías</a>
                </div>
            </nav>

            <div class="col-md-9 ms-sm-auto col-lg-10 content tab-content" id="v-pills-tabContent">

                <main class="tab-pane fade show active" id="usuarios" role="tabpanel">
                    <h2>Gestión de Usuarios</h2>
                    <div class="mb-3 text-end">
                        <button class="btn btn-success">+ Añadir nuevo</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Rol</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($administradores as $admin): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $admin["id_usuario"]; ?></td>
                                        <td><?php echo htmlspecialchars($admin["nombre"]); ?></td>
                                        <td><?php echo htmlspecialchars($admin["email"]); ?></td>
                                        <td><?php echo htmlspecialchars($admin["telefono"]); ?></td>
                                        <td class="text-center"><?php echo ucfirst($admin["rol"]); ?></td>
                                        <td class="text-center"><?php echo $admin["activo"] ? "Sí" : "No"; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary disabled">Editar</button>
                                            <button class="btn btn-sm btn-danger disabled">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </main>

                <main class="tab-pane fade" id="ninos" role="tabpanel">
                    <h2>Gestión de Niños</h2>
                </main>

                <main class="tab-pane fade" id="padres" role="tabpanel">
                    <h2>Gestión de Padres</h2>

                </main>

                <main class="tab-pane fade" id="profesores" role="tabpanel">
                    <h2>Gestión de Profesores</h2>

                </main>

                <main class="tab-pane fade" id="aulas" role="tabpanel">
                    <h2>Gestión de Aulas</h2>

                </main>

                <main class="tab-pane fade" id="clientes" role="tabpanel">
                    <h2>Gestión de Clientes</h2>

                </main>

                <main class="tab-pane fade" id="guarderias" role="tabpanel">
                    <h2>Gestión de Guarderías</h2>

                </main>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
</body>

</html>