<?php
session_start();
$tiempo_inactividad = 1800; // 30 minutos en segundos
require 'const/conexion.php';

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $tiempo_inactividad) {
    session_unset();
    session_destroy();
    header("Location: login.php?expirada");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Actualiza el tiempo de última actividad

//**************************** VISTA USUARIOS ***********************************
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/usuarios";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_usuarios = json_decode($respuesta, true);
$usuarios = $json_usuarios["usuarios"];

if (isset($_POST["crear_usuario"])) {

    $datos = [
        "email" => $_POST["email"],
        "contrasenya" => password_hash($_POST["contrasenya"], PASSWORD_DEFAULT),
        "nombre" => $_POST["nombre"],
        "telefono" => $_POST["telefono"],
        "rol" => $_POST["rol"],
    ];

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearUsuario";
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensaje"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensaje"] = "<div class='alert alert-success'>Usuario creado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

if (isset($_POST["btnBorrarUsuario"])) {

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarUsuario/" . $_POST["btnBorrarUsuario"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensaje"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensaje"] = "<div class='alert alert-success'>Usuario eliminado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

$mostrar_modal_editar = false;
$datos_usuario_editar = [];

if (isset($_POST["btnEditarUsuario"])) {

    $url = DIR_SERV . "/usuario/" . $_POST["btnEditarUsuario"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json = json_decode($respuesta, true);

    if (isset($json["usuario"])) {
        $datos_usuario_editar = $json["usuario"];
        $mostrar_modal_editar = true;
    }
}

if (isset($_POST["editar_usuario"])) {

    $datos = [
        "email" => $_POST["email"],
        "nombre" => $_POST["nombre"],
        "telefono" => $_POST["telefono"],
        "rol" => $_POST["rol"],
    ];

    $url = DIR_SERV . "/actualizarUsuario/" . $_POST["id_usuario"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "PUT", $headers, $datos);
    $json = json_decode($respuesta, true);


    if (isset($json["error"])) {
        $_SESSION["mensaje"] = "<div class='alert alert-danger'>Error: " . $json["error"] . "</div>";
    } else {
        $_SESSION["mensaje"] = "<div class='alert alert-success'>Usuario actualizado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

//**************************** VISTA NIÑOS ***********************************
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/ninos";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_ninos = json_decode($respuesta, true);
$ninos = $json_ninos["ninos"];

//RELLENAR LOS SELECT DE AÑADIR Y EDITAR
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/idNombreAulas";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_aulas_id_nombre = json_decode($respuesta, true);
$aulas_id_nombre = $json_aulas_id_nombre["aulas_id_nombre"];

$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/idNombrePadres";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_padres_id_nombre = json_decode($respuesta, true);
$padres_id_nombres = $json_padres_id_nombre["padres_id_nombre"];

//CRUD NIÑO
if (isset($_POST["crear_nino"])) {
    $datos = [
        "id_padre" => $_POST["padre"],
        "id_aula" => $_POST["aula"],
        "nombre" => $_POST["nombre"],
        "apellidos" => $_POST["apellidos"],
        "fecha_nacimiento" => $_POST["fechaNacimiento"],
        "genero" => $_POST["genero"],
        "acerca" => $_POST["acerca"],
        "observaciones" => $_POST["observaciones"],

    ];

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearNino";
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeNino"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeNino"] = "<div class='alert alert-success'>Niño creado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

if (isset($_POST["btnBorrarNino"])) {
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarNino/" . $_POST["btnBorrarNino"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeNino"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeNino"] = "<div class='alert alert-success'>Niño eliminado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

$mostrar_modal_editar_nino = false;
$datos_nino_editar = [];

if (isset($_POST["btnEditarNino"])) {

    $url = DIR_SERV . "/nino/" . $_POST["btnEditarNino"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json = json_decode($respuesta, true);

    if (isset($json["datos_nino"])) {
        $datos_nino_editar = $json["datos_nino"];
        $mostrar_modal_editar_nino = true;
    }
}


if (isset($_POST["editar_nino"])) {

    $datos = [
        "nombre" => $_POST["nombre"],
        "apellidos" => $_POST["apellidos"],
        "acerca" => $_POST["acerca"],
        "observaciones" => $_POST["observaciones"],
    ];

    $url = DIR_SERV . "/actualizarNino/" . $_POST["id_nino"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "PUT", $headers, $datos);
    $json = json_decode($respuesta, true);


    if (isset($json["error"])) {
        $_SESSION["mensajeNino"] = "<div class='alert alert-danger'>Error: " . $json["error"] . "</div>";
    } else {
        $_SESSION["mensajeNino"] = "<div class='alert alert-success'>Niño actualizado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

//**************************** VISTA AULAS ***********************************
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/aulas";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_aulas = json_decode($respuesta, true);
$aulas = $json_aulas["aulas"];

//RELLENAR EL SELECT DE GUARDERIA
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/idNombreGuarderias";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_guarderias_id_nombre = json_decode($respuesta, true);
$guarderias_id_nombre = $json_guarderias_id_nombre["guarderias_id_nombre"];

//CRUD AULA
if (isset($_POST["crear_aula"])) {

    $datos = [
        "id_guarderia" => $_POST["guarderias"],
        "nombre_aula" => $_POST["nombre"],
        "capacidad" => $_POST["capacidad"],
    ];

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearAula";
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeAula"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeAula"] = "<div class='alert alert-success'>Aula creada correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

if (isset($_POST["btnBorrarAula"])) {

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarAula/" . $_POST["btnBorrarAula"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeAula"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeAula"] = "<div class='alert alert-success'>Aula eliminada correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

$mostrar_modal_editar_aula = false;
$datos_aula_editar = [];

if (isset($_POST["btnEditarAula"])) {

    $url = DIR_SERV . "/aula/" . $_POST["btnEditarAula"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json = json_decode($respuesta, true);

    if (isset($json["datos_aula"])) {
        $datos_aula_editar = $json["datos_aula"];
        $mostrar_modal_editar_aula = true;
    }
}


if (isset($_POST["editar_aula"])) {
    $datos = [
        "nombre_aula" => $_POST["nombre"],
        "capacidad" => $_POST["capacidad"],
    ];

    $url = DIR_SERV . "/actualizarAula/" . $_POST["id_aula"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "PUT", $headers, $datos);
    $json = json_decode($respuesta, true);


    if (isset($json["error"])) {
        $_SESSION["mensajeAula"] = "<div class='alert alert-danger'>Error: " . $json["error"] . "</div>";
    } else {
        $_SESSION["mensajeAula"] = "<div class='alert alert-success'>Aula actualizada correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

//**************************** VISTA CLIENTES ***********************************
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/clientes";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_clientes = json_decode($respuesta, true);
$clientes = $json_clientes["clientes"];

//CRUD CLIENTE
if (isset($_POST["crear_cliente"])) {

    $datos = [
        "nombre" => $_POST["nombre"],
        "email" => $_POST["email"],
        "telefono" => $_POST["telefono"],
        "cif" => $_POST["cif"],
        "observaciones" => $_POST["observaciones"],
    ];

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearCliente";
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
    $json_mensaje = json_decode($respuesta, true);


    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-success'>Cliente creado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

if (isset($_POST["btnBorrarCliente"])) {

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarCliente/" . $_POST["btnBorrarCliente"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-success'>Cliente eliminado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

$mostrar_modal_editar_cliente = false;
$datos_cliente_editar = [];

if (isset($_POST["btnEditarCliente"])) {

    $url = DIR_SERV . "/cliente/" . $_POST["btnEditarCliente"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json = json_decode($respuesta, true);

    if (isset($json["datos_cliente"])) {
        $datos_cliente_editar = $json["datos_cliente"];
        $mostrar_modal_editar_cliente = true;
    }
}

if (isset($_POST["editar_cliente"])) {
    $datos = [
        "nombre" => $_POST["nombre"],
        "email" => $_POST["email"],
        "telefono" => $_POST["telefono"],
        "cif" => $_POST["cif"],
        "observaciones" => $_POST["observaciones"],

    ];

    $url = DIR_SERV . "/actualizarCliente/" . $_POST["id_cliente"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "PUT", $headers, $datos);
    $json = json_decode($respuesta, true);

    if (isset($json["error"])) {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-danger'>Error: " . $json["error"] . "</div>";
    } else {
        $_SESSION["mensajeCliente"] = "<div class='alert alert-success'>Cliente actualizado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

//**************************** VISTA GUARDERIAS ***********************************
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/guarderias";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_guarderias = json_decode($respuesta, true);
$guarderias = $json_guarderias["guarderias"];

//RELLENAR EL SELECT DE CLIENTES
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/idNombreClientes";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_clientes_id_nombre = json_decode($respuesta, true);
$clientes_id_nombre = $json_clientes_id_nombre["clientes_id_nombre"];

//CRUD GUARDERIA
if (isset($_POST["crear_guarderia"])) {

    $datos = [
        "id_cliente" => $_POST["cliente"],
        "nombre_guarderia" => $_POST["nombre"],
        "direccion" => $_POST["direccion"],
        "telefono" => $_POST["telefono"],
    ];

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearGuarderia";
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-success'>Guarderia creada correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

if (isset($_POST["btnBorrarGuarderia"])) {

    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarGuarderia/" . $_POST["btnBorrarGuarderia"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_mensaje = json_decode($respuesta, true);

    if (isset($json_mensaje["error"])) {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-danger'>Error: " . $json_mensaje["error"] . "</div>";
    } else {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-success'>Guarderia eliminado correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}

$mostrar_modal_editar_guarderia = false;
$datos_guarderia_editar = [];

if (isset($_POST["btnEditarGuarderia"])) {

    $url = DIR_SERV . "/guarderia/" . $_POST["btnEditarGuarderia"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json = json_decode($respuesta, true);

    if (isset($json["datos_guarderia"])) {
        $datos_guarderia_editar = $json["datos_guarderia"];
        $mostrar_modal_editar_guarderia = true;
    }
}

if (isset($_POST["editar_guarderia"])) {
    $datos = [
        "id_cliente" => $_POST["cliente"],
        "nombre_guarderia" => $_POST["nombre"],
        "direccion" => $_POST["direccion"],
        "telefono" => $_POST["telefono"],

    ];

    $url = DIR_SERV . "/actualizarGuarderia/" . $_POST["id_guarderia"];
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $respuesta = consumir_servicios_JWT_REST($url, "PUT", $headers, $datos);
    $json = json_decode($respuesta, true);

    if (isset($json["error"])) {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-danger'>Error: " . $json["error"] . "</div>";
    } else {
        $_SESSION["mensajeGuarderia"] = "<div class='alert alert-success'>Guarderia actualizada correctamente.</div>";
        header("Location: vista_admin.php");
        exit();
    }
}


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
                    <a class="nav-link" id="aulas-tab" data-bs-toggle="pill" href="#aulas" role="tab">Aulas</a>
                    <a class="nav-link" id="clientes-tab" data-bs-toggle="pill" href="#clientes" role="tab">Clientes</a>
                    <a class="nav-link" id="guarderia-tab" data-bs-toggle="pill" href="#guarderia" role="tab">Guarderias</a>

                </div>
            </nav>

            <div class="col-md-9 ms-sm-auto col-lg-10 content tab-content" id="v-pills-tabContent">

                <main class="tab-pane fade show active" id="usuarios" role="tabpanel">

                    <h2>Gestión de Usuarios</h2>

                    <?php if (isset($_SESSION["mensaje"])) echo $_SESSION["mensaje"];
                    unset($_SESSION['mensaje']); ?>

                    <div class="mb-3 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">+ Añadir nuevo</button>
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
                                <?php foreach ($usuarios as $usu): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $usu["id_usuario"]; ?></td>
                                        <td><?php echo htmlspecialchars($usu["nombre"]); ?></td>
                                        <td><?php echo htmlspecialchars($usu["email"]); ?></td>
                                        <td><?php echo htmlspecialchars($usu["telefono"]); ?></td>
                                        <td class="text-center"><?php echo ucfirst($usu["rol"]); ?></td>
                                        <td class="text-center"><?php echo $usu["activo"] ? "Sí" : "No"; ?></td>
                                        <td class="text-center">

                                            <?php
                                            if ($usu["rol"] == "admin") {
                                                echo "<button class='btn btn-sm btn-primary me-2 disabled'>Editar</button>";
                                                echo "<button class='btn btn-sm btn-danger disabled'>Eliminar</button>";
                                            } else {
                                                echo "<form method='POST'><button type='submit' name='btnEditarUsuario' value=" . $usu["id_usuario"] . " class='btn btn-sm btn-primary me-2'>Editar</button>";
                                                echo "<button type='submit' name='btnBorrarUsuario' value=" . $usu["id_usuario"] . " class='btn btn-sm btn-danger'>Eliminar</button></form>";
                                            }

                                            ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- MODAL CREAR USUARIO -->
                    <div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Crear Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>


                                <div class="modal-body">
                                    <form id="formularioModal" method="POST">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="rol" class="form-label">Rol</label>
                                                <select class="form-select" id="rol" name="rol" required>
                                                    <option value="padre">Padre</option>
                                                    <option value="profesor">Profesor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasenya" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasenya" name="contrasenya" required>
                                        </div>
                                    </form>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="color: white;background-color: black;">Cerrar</button>
                                    <button type="submit" name="crear_usuario" form="formularioModal" class="btn" style="color: white;background-color: #12578e;">Crear usuario</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL EDITAR USUARIO -->
                    <?php if ($mostrar_modal_editar): ?>
                        <div class="modal fade show" id="modalEditarUsuario" tabindex="-1" aria-labelledby="miModalLabel" aria-modal="true" role="dialog" style="display:block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header position-relative">
                                        <h5 class="modal-title" id="miModalLabel">Editar Usuario</h5>
                                        <button type="button" id="cerrarModalX" class="btn-close position-absolute top-0 end-0 p-2 m-1" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="formularioModal2" method="POST">
                                            <input type="hidden" name="id_usuario" value="<?= $datos_usuario_editar["id_usuario"] ?>">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" required value="<?= $datos_usuario_editar["nombre"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <input type="email" class="form-control" name="email" required value="<?= $datos_usuario_editar["email"] ?>">
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="tel" class="form-control" name="telefono" required value="<?= $datos_usuario_editar["telefono"] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="rol" class="form-label">Rol</label>
                                                    <select class="form-select" name="rol" required>
                                                        <option value="padre" <?= $datos_usuario_editar["rol"] == "padre" ? "selected" : "" ?>>Padre</option>
                                                        <option value="profesor" <?= $datos_usuario_editar["rol"] == "profesor" ? "selected" : "" ?>>Profesor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="contrasenya" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" name="contrasenya" disabled>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="cerrarModalBtn" class="btn" style="background-color: black; color: white;">Cerrar</button>
                                        <button type="submit" name="editar_usuario" form="formularioModal2" class="btn" value="<?php $datos_usuario_editar["id_usuario"] ?>" style="color: white;background-color: #12578e;">Editar usuario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalBackdrop" class="modal-backdrop fade show"></div>

                        <script>
                            function cerrarModal() {
                                const modal = document.getElementById('modalEditarUsuario');
                                const backdrop = document.getElementById('modalBackdrop');
                                if (modal) {
                                    modal.style.display = 'none';
                                    modal.classList.remove('show');
                                }
                                if (backdrop) {
                                    backdrop.style.display = 'none';
                                    backdrop.classList.remove('show');
                                }
                                document.body.classList.remove('modal-open');

                            }

                            // Cerrar al pulsar botón X
                            document.getElementById('cerrarModalX').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar botón Cerrar
                            document.getElementById('cerrarModalBtn').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar tecla ESC
                            document.addEventListener('keydown', function(event) {
                                if (event.key === "Escape" || event.key === "Esc") {
                                    cerrarModal();
                                }
                            });
                        </script>
                    <?php endif; ?>



                </main>

                <main class="tab-pane fade" id="ninos" role="tabpanel">
                    <h2>Gestión de Niños</h2>

                    <?php if (isset($_SESSION["mensajeNino"])) echo $_SESSION["mensajeNino"];
                    unset($_SESSION['mensajeNino']); ?>

                    <div class="mb-3 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearNino">+ Añadir nuevo</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Padre / Madre</th>
                                    <th>Aula</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Género</th>
                                    <th>Acerca</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ninos as $nin): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $nin["id_nino"]; ?></td>
                                        <td><?php echo htmlspecialchars($nin["nombre"]); ?></td>
                                        <td><?php echo htmlspecialchars($nin["apellidos"]); ?></td>
                                        <td><?php echo $nin["nombre_padre"] ?></td>
                                        <td class="text-center"><?php echo $nin["nombre_aula"] ?></td>
                                        <td class="text-center"><?php echo (new DateTime($nin["fecha_nacimiento"]))->format('d-m-Y'); ?></td>
                                        <td class="text-center"><?= ucfirst($nin["genero"]); ?></td>
                                        <td class="text-center"><?= empty($nin["acerca"]) ? '-' : $nin["acerca"]; ?></td>
                                        <td class="text-center"><?= empty($nin["observaciones"]) ? '-' : $nin["observaciones"]; ?></td>

                                        <td class="text-center">
                                            <?php
                                            echo "<form method='POST'><button  type='submit' name='btnEditarNino' value=" . $nin["id_nino"] . " class='btn btn-sm btn-primary me-2'>Editar</button>";
                                            echo "<button type='submit' name='btnBorrarNino' value=" . $nin["id_nino"] . " class='btn btn-sm btn-danger'>Eliminar</button></form>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Añadir niño -->
                    <div class="modal fade" id="modalCrearNino" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Crear Niño</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="miFormulario3" method="POST">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label for="padre" class="form-label">Padre</label>
                                                <select id="padre" name="padre" class="form-select" required>
                                                    <option value="">Seleccione un padre</option>
                                                    <?php foreach ($padres_id_nombres as $id_nombre_padre): ?>
                                                        <option value="<?= htmlspecialchars($id_nombre_padre['id_usuario']) ?>">
                                                            <?= htmlspecialchars($id_nombre_padre['nombre']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="aula" class="form-label">Aula</label>
                                                <select id="aula" name="aula" class="form-select" required>
                                                    <option value="">Seleccione un aula</option>
                                                    <?php foreach ($aulas_id_nombre as $aula): ?>
                                                        <option value="<?= htmlspecialchars($aula['id_aula']) ?>">
                                                            <?= htmlspecialchars($aula['nombre_aula']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control" required />
                                            </div>


                                            <div class="col-md-6">
                                                <label for="apellidos" class="form-label">Apellidos</label>
                                                <input type="text" id="apellidos" name="apellidos" class="form-control" required />
                                            </div>


                                            <div class="col-md-6">
                                                <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
                                                <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required />
                                            </div>


                                            <div class="col-md-6">
                                                <label class="form-label d-block">Género</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="genero" id="generoMasculino" value="masculino" required>
                                                    <label class="form-check-label" for="generoMasculino">Masculino</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="genero" id="generoFemenino" value="femenino" required>
                                                    <label class="form-check-label" for="generoFemenino">Femenino</label>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <label for="acerca" class="form-label">Acerca</label>
                                                <textarea id="acerca" name="acerca" class="form-control" rows="3"></textarea>
                                            </div>

                                            <div class="col-12">
                                                <label for="observaciones" class="form-label">Observaciones</label>
                                                <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </form>


                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="color: white;background-color: black;">Cerrar</button>
                                    <button type="submit" name="crear_nino" form="miFormulario3" class="btn" style="color: white;background-color: #12578e;">Crear niño</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDITAR NIÑO -->
                    <?php if ($mostrar_modal_editar_nino): ?>
                        <div class="modal fade show" id="modalEditarNino" tabindex="-1" aria-labelledby="miModalLabel" aria-modal="true" role="dialog" style="display:block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header position-relative">
                                        <h5 class="modal-title" id="miModalLabel">Editar Niño</h5>
                                        <button type="button" id="cerrarModalX" class="btn-close position-absolute top-0 end-0 p-2 m-1" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="formularioModal3" method="POST">
                                            <input type="hidden" name="id_nino" value="<?= $datos_nino_editar["id_nino"] ?>">

                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" required value="<?= $datos_nino_editar["nombre"] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="apellidos" class="form-label">Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos" required value="<?= $datos_nino_editar["apellidos"] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="acerca" class="form-label">Acerca</label>
                                                <textarea class="form-control" name="acerca" rows="3"><?= $datos_nino_editar["acerca"] ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="observaciones" class="form-label">Observaciones</label>
                                                <textarea class="form-control" name="observaciones" rows="3"><?= $datos_nino_editar["observaciones"] ?></textarea>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="cerrarModalBtn" class="btn" style="background-color: black; color: white;">Cerrar</button>
                                        <button type="submit" name="editar_nino" form="formularioModal3" class="btn" value="<?php $datos_nino_editar["id_nino"] ?>" style="color: white;background-color: #12578e;">Editar usuario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalBackdrop" class="modal-backdrop fade show"></div>

                        <script>
                            function cerrarModal() {
                                const modal = document.getElementById('modalEditarNino');
                                const backdrop = document.getElementById('modalBackdrop');
                                if (modal) {
                                    modal.style.display = 'none';
                                    modal.classList.remove('show');
                                }
                                if (backdrop) {
                                    backdrop.style.display = 'none';
                                    backdrop.classList.remove('show');
                                }
                                document.body.classList.remove('modal-open');

                            }

                            // Cerrar al pulsar botón X
                            document.getElementById('cerrarModalX').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar botón Cerrar
                            document.getElementById('cerrarModalBtn').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar tecla ESC
                            document.addEventListener('keydown', function(event) {
                                if (event.key === "Escape" || event.key === "Esc") {
                                    cerrarModal();
                                }
                            });
                        </script>
                    <?php endif; ?>
                </main>

                <main class="tab-pane fade" id="aulas" role="tabpanel">
                    <h2>Gestión de Aulas</h2>

                    <?php if (isset($_SESSION["mensajeAula"])) echo $_SESSION["mensajeAula"];
                    unset($_SESSION['mensajeAula']); ?>

                    <div class="mb-3 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearAula">+ Añadir nueva</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre aula</th>
                                    <th>Nombre Guarderia</th>
                                    <th>Capacidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aulas as $au): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $au["id_aula"]; ?></td>
                                        <td><?php echo htmlspecialchars($au["nombre_aula"]); ?></td>
                                        <td><?php echo htmlspecialchars($au["nombre_guarderia"]); ?></td>
                                        <td class="text-center"><?php echo $au["capacidad"] ?></td>
                                        <td class="text-center">
                                            <?php
                                            echo "<form method='POST'><button  type='submit' name='btnEditarAula' value=" . $au["id_aula"] . " class='btn btn-sm btn-primary me-2'>Editar</button>";
                                            echo "<button type='submit' name='btnBorrarAula' value=" . $au["id_aula"] . " class='btn btn-sm btn-danger'>Eliminar</button></form>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Añadir AULA -->
                    <div class="modal fade" id="modalCrearAula" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Crear Aula</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="miFormulario4" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre del aula</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="capacidad" class="form-label">Capacidad</label>
                                                <input type="number" id="capacidad" name="capacidad" class="form-control" required min="1" step="1" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="guarderias" class="form-label">Guarderías</label>
                                                <select id="guarderias" name="guarderias" class="form-select" required>
                                                    <option value="">Seleccione una guardería</option>
                                                    <?php foreach ($guarderias_id_nombre as $guarderia): ?>
                                                        <option value="<?= htmlspecialchars($guarderia['id_guarderia']) ?>">
                                                            <?= htmlspecialchars($guarderia['nombre_guarderia']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="color: white;background-color: black;">Cerrar</button>
                                    <button type="submit" name="crear_aula" form="miFormulario4" class="btn" style="color: white;background-color: #12578e;">Crear aula</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDITAR NIÑO -->
                    <?php if ($mostrar_modal_editar_aula): ?>
                        <div class="modal fade show" id="modalEditarAula" tabindex="-1" aria-labelledby="miModalLabel" aria-modal="true" role="dialog" style="display:block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header position-relative">
                                        <h5 class="modal-title" id="miModalLabel">Editar Niño</h5>
                                        <button type="button" id="cerrarModalX" class="btn-close position-absolute top-0 end-0 p-2 m-1" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="formularioModal4" method="POST">
                                            <input type="hidden" name="id_aula" value="<?= $datos_aula_editar["id_aula"] ?>">

                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" required value="<?= htmlspecialchars($datos_aula_editar["nombre_aula"]) ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="capacidad" class="form-label">Capacidad</label>
                                                <input type="number" class="form-control" name="capacidad" min="1" required value="<?= htmlspecialchars($datos_aula_editar["capacidad"]) ?>">
                                            </div>
                                        </form>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="cerrarModalBtn" class="btn" style="background-color: black; color: white;">Cerrar</button>
                                        <button type="submit" name="editar_aula" form="formularioModal4" class="btn" value="<?php $datos_aula_editar["id_aula"] ?>" style="color: white;background-color: #12578e;">Editar usuario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalBackdrop" class="modal-backdrop fade show"></div>

                        <script>
                            function cerrarModal() {
                                const modal = document.getElementById('modalEditarAula');
                                const backdrop = document.getElementById('modalBackdrop');
                                if (modal) {
                                    modal.style.display = 'none';
                                    modal.classList.remove('show');
                                }
                                if (backdrop) {
                                    backdrop.style.display = 'none';
                                    backdrop.classList.remove('show');
                                }
                                document.body.classList.remove('modal-open');

                            }

                            // Cerrar al pulsar botón X
                            document.getElementById('cerrarModalX').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar botón Cerrar
                            document.getElementById('cerrarModalBtn').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar tecla ESC
                            document.addEventListener('keydown', function(event) {
                                if (event.key === "Escape" || event.key === "Esc") {
                                    cerrarModal();
                                }
                            });
                        </script>
                    <?php endif; ?>

                </main>

                <main class="tab-pane fade" id="clientes" role="tabpanel">
                    <h2>Gestión de Clientes</h2>

                    <?php if (isset($_SESSION["mensajeCliente"])) echo $_SESSION["mensajeCliente"];
                    unset($_SESSION['mensajeCliente']); ?>

                    <div class="mb-3 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">+ Añadir nuevo</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Cliente</th>
                                    <th>Email de contacto</th>
                                    <th>Télefono</th>
                                    <th>Cif</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $c): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $c["id_cliente"]; ?></td>
                                        <td><?php echo htmlspecialchars($c["nombre"]); ?></td>
                                        <td><?php echo htmlspecialchars($c["email"]); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($c["telefono"]); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($c["cif"]); ?></td>
                                        <td><?php echo $c["observaciones"] ?></td>
                                        <td class="text-center">
                                            <?php
                                            echo "<form method='POST'><button  type='submit' name='btnEditarCliente' value=" . $c["id_cliente"] . " class='btn btn-sm btn-primary me-2'>Editar</button>";
                                            echo "<button type='submit' name='btnBorrarCliente' value=" . $c["id_cliente"] . " class='btn btn-sm btn-danger'>Eliminar</button></form>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Añadir Cliente -->
                    <div class="modal fade" id="modalCrearCliente" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Crear Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="miFormulario5" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <input type="email" id="email" name="email" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" id="telefono" name="telefono" class="form-control" required pattern="[0-9]{9}" title="Debe tener 9 dígitos" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cif" class="form-label">CIF</label>
                                                <input type="text" id="cif" name="cif" class="form-control" required pattern="[A-Z0-9]{8,10}" title="Debe tener entre 8 y 10 caracteres alfanuméricos" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="observaciones" class="form-label">Observaciones</label>
                                                <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </form>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="color: white;background-color: black;">Cerrar</button>
                                    <button type="submit" name="crear_cliente" form="miFormulario5" class="btn" style="color: white;background-color: #12578e;">Crear cliente</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDITAR CLIENTE -->
                    <?php if ($mostrar_modal_editar_cliente): ?>
                        <div class="modal fade show" id="modalEditarCliente" tabindex="-1" aria-labelledby="miModalLabel" aria-modal="true" role="dialog" style="display:block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header position-relative">
                                        <h5 class="modal-title" id="miModalLabel">Editar Cliente</h5>
                                        <button type="button" id="cerrarModalX" class="btn-close position-absolute top-0 end-0 p-2 m-1" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="formularioModal5" method="POST">
                                            <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($datos_cliente_editar["id_cliente"]) ?>">

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="nombre" required value="<?= htmlspecialchars($datos_cliente_editar["nombre"]) ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Correo electrónico</label>
                                                    <input type="email" class="form-control" name="email" required value="<?= htmlspecialchars($datos_cliente_editar["email"]) ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="tel" class="form-control" name="telefono" required pattern="[0-9]{9}" title="Debe tener 9 dígitos" value="<?= htmlspecialchars($datos_cliente_editar["telefono"]) ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="cif" class="form-label">CIF</label>
                                                    <input type="text" class="form-control" name="cif" required pattern="[A-Z0-9]{8,10}" title="Debe tener entre 8 y 10 caracteres alfanuméricos" value="<?= htmlspecialchars($datos_cliente_editar["cif"]) ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label for="observaciones" class="form-label">Observaciones</label>
                                                    <textarea class="form-control" name="observaciones" rows="3"><?= htmlspecialchars($datos_cliente_editar["observaciones"]) ?></textarea>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="cerrarModalBtn" class="btn" style="background-color: black; color: white;">Cerrar</button>
                                        <button type="submit" name="editar_cliente" form="formularioModal5" class="btn" value="<?php $datos_cliente_editar["id_cliente"] ?>" style="color: white;background-color: #12578e;">Editar usuario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalBackdrop" class="modal-backdrop fade show"></div>

                        <script>
                            function cerrarModal() {
                                const modal = document.getElementById('modalEditarCliente');
                                const backdrop = document.getElementById('modalBackdrop');
                                if (modal) {
                                    modal.style.display = 'none';
                                    modal.classList.remove('show');
                                }
                                if (backdrop) {
                                    backdrop.style.display = 'none';
                                    backdrop.classList.remove('show');
                                }
                                document.body.classList.remove('modal-open');

                            }

                            // Cerrar al pulsar botón X
                            document.getElementById('cerrarModalX').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar botón Cerrar
                            document.getElementById('cerrarModalBtn').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar tecla ESC
                            document.addEventListener('keydown', function(event) {
                                if (event.key === "Escape" || event.key === "Esc") {
                                    cerrarModal();
                                }
                            });
                        </script>
                    <?php endif; ?>

                </main>

                <main class="tab-pane fade" id="guarderia" role="tabpanel">
                    <h2>Gestión de Guarderías</h2>

                    <?php if (isset($_SESSION["mensajeGuarderia"])) echo $_SESSION["mensajeGuarderia"];
                    unset($_SESSION['mensajeGuarderia']); ?>

                    <div class="mb-3 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearGuarderia">+ Añadir nueva</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Nombre Cliente</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($guarderias as $g): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $g["id_guarderia"]; ?></td>
                                        <td><?php echo htmlspecialchars($g["nombre_guarderia"]); ?></td>
                                        <td><?php echo htmlspecialchars($g["nombre_cliente"]); ?></td>
                                        <td><?php echo htmlspecialchars($g["direccion"]); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($g["telefono"]); ?></td>
                                        <td class="text-center">
                                            <?php
                                            echo "<form method='POST'><button  type='submit' name='btnEditarGuarderia' value=" . $g["id_guarderia"] . " class='btn btn-sm btn-primary me-2'>Editar</button>";
                                            echo "<button type='submit' name='btnBorrarGuarderia' value=" . $g["id_guarderia"] . " class='btn btn-sm btn-danger'>Eliminar</button></form>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- MODAL AÑADIR GUARDERIA -->
                    <div class="modal fade" id="modalCrearGuarderia" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Crear Guarderia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="miFormulario6" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cliente" class="form-label">Cliente</label>
                                                <select id="cliente" name="cliente" class="form-select" required>
                                                    <option value="">Seleccione un cliente</option>
                                                    <?php foreach ($clientes_id_nombre as $cliente): ?>
                                                        <option value="<?= htmlspecialchars($cliente['id_cliente']) ?>">
                                                            <?= htmlspecialchars($cliente['nombre_cliente']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" id="direccion" name="direccion" class="form-control" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" id="telefono" name="telefono" class="form-control" required pattern="[0-9]{9}" title="Debe tener 9 dígitos" />
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="color: white;background-color: black;">Cerrar</button>
                                    <button type="submit" name="crear_guarderia" form="miFormulario6" class="btn" style="color: white;background-color: #12578e;">Crear guarderia</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDITAR GUARDERIA -->
                    <?php if ($mostrar_modal_editar_guarderia): ?>
                        <div class="modal fade show" id="modalEditarGuarderia" tabindex="-1" aria-labelledby="miModalLabel" aria-modal="true" role="dialog" style="display:block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header position-relative">
                                        <h5 class="modal-title" id="miModalLabel">Editar Guarderia</h5>
                                        <button type="button" id="cerrarModalX" class="btn-close position-absolute top-0 end-0 p-2 m-1" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="formularioModal6" method="POST">
                                            <input type="hidden" name="id_guarderia" value="<?= htmlspecialchars($datos_guarderia_editar["id_guarderia"]) ?>">

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" id="nombre" class="form-control" name="nombre" required value="<?= htmlspecialchars($datos_guarderia_editar["nombre_guarderia"]) ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="cliente" class="form-label">Cliente</label>
                                                    <select id="cliente" class="form-select" name="cliente" required>
                                                        <option value="">Seleccione un cliente</option>
                                                        <?php foreach ($clientes as $cliente): ?>
                                                            <option value="<?= htmlspecialchars($cliente['id_cliente']) ?>" <?= ($datos_guarderia_editar["id_cliente"] == $cliente['id_cliente']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($cliente['nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="direccion" class="form-label">Dirección</label>
                                                    <input type="text" id="direccion" class="form-control" name="direccion" required value="<?= htmlspecialchars($datos_guarderia_editar["direccion"]) ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="tel" id="telefono" class="form-control" name="telefono" required pattern="[0-9]{9}" title="Debe tener 9 dígitos" value="<?= htmlspecialchars($datos_guarderia_editar["telefono"]) ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="cerrarModalBtn" class="btn" style="background-color: black; color: white;">Cerrar</button>
                                        <button type="submit" name="editar_guarderia" form="formularioModal6" class="btn" value="<?php $datos_guarderia_editar["id_guarderia"] ?>" style="color: white;background-color: #12578e;">Editar guarderia</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalBackdrop" class="modal-backdrop fade show"></div>

                        <script>
                            function cerrarModal() {
                                const modal = document.getElementById('modalEditarGuarderia');
                                const backdrop = document.getElementById('modalBackdrop');
                                if (modal) {
                                    modal.style.display = 'none';
                                    modal.classList.remove('show');
                                }
                                if (backdrop) {
                                    backdrop.style.display = 'none';
                                    backdrop.classList.remove('show');
                                }
                                document.body.classList.remove('modal-open');

                            }

                            // Cerrar al pulsar botón X
                            document.getElementById('cerrarModalX').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar botón Cerrar
                            document.getElementById('cerrarModalBtn').addEventListener('click', cerrarModal);

                            // Cerrar al pulsar tecla ESC
                            document.addEventListener('keydown', function(event) {
                                if (event.key === "Escape" || event.key === "Esc") {
                                    cerrarModal();
                                }
                            });
                        </script>
                    <?php endif; ?>

                </main>

            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
    <script>
        //MANTENER EL TAB CUANDO RECARGUES
        document.addEventListener('DOMContentLoaded', function() {
            const activeTabId = localStorage.getItem('activeTabId');

            if (activeTabId) {
                const triggerEl = document.getElementById(activeTabId);

                if (triggerEl) {
                    const tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            }

            const tabLinks = document.querySelectorAll('.nav-link[data-bs-toggle="pill"]');
            tabLinks.forEach(link => {
                link.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('activeTabId', event.target.id);
                });
            });
        });
    </script>
</body>

</html>