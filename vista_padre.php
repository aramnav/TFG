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
    header("Location: login.php?expirada");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Actualiza el tiempo de última actividad

$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/usuario/" . $_SESSION["usuario"]["id_usuario"];
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_usuario = json_decode($respuesta, true);

$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/hijos/" . $_SESSION["usuario"]["id_usuario"];
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_hijos = json_decode($respuesta, true);


if (!isset($json_hijos["mensaje"])) {
    $datos_hijo = $json_hijos["hijos"];

    if (isset($json_hijos["hijos"]) && isset($json_hijos["hijos"]["id_nino"])) {
        $datos_hijo = [$json_hijos["hijos"]];
    } else {
        $datos_hijo = $json_hijos["hijos"];
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>

<style>
    .profile-header {
        position: relative;
        height: 200px;
        background-size: cover;
        background-position: center;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        overflow: visible;
    }

    .profile-pic {
        position: absolute;
        bottom: -100px;
        left: 50%;
        transform: translateX(-50%);
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        background-color: white;
    }

    .nav-link {
        color: #333;
        border: none;
        border-bottom: 4px solid transparent;
    }

    .nav-link.active {
        color: #12578e;
        border-bottom: 4px solid #12578e;
    }

    .nav-link:hover {
        color: #12578e
    }

    .data-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
    }

    .data-value {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .section-divider {
        border-bottom: 2px solid #dee2e6;
    }
</style>


<body>
    <?php require 'header.php'; ?>

    <h1>Perfil</h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?php if (empty($datos_hijo)): ?>
                <div class='alert alert-danger' style="margin:0 auto;">El padre no tiene hijos asignados.</div>
            <?php else: ?>
                <?php foreach ($datos_hijo as $index => $hijo): ?>
                    <div class="swiper-slide">
                        <div class="container bg-white rounded shadow" style="margin: 0; margin:0 auto; margin-bottom:100px;">
                            <div class="profile-header" style="background-image: url('recursos/img/<?php echo strtolower($hijo['genero']) === 'masculino' ? 'fondo_nino.webp' : 'fondo_nina.webp'; ?>');">
                                <img src="recursos/img/foto_perfil.webp" alt="Foto perfil" class="profile-pic">
                            </div>

                            <div class="text-center mt-5 pt-4">
                                <h2 class="fw-bold"><?php echo $hijo["nombre"]; ?></h2>
                                <p class="text-muted fs-5">
                                    <?php echo (new DateTime($hijo["fecha_nacimiento"]))->diff(new DateTime())->y . " años"; ?>
                                </p>
                            </div>

                            <ul class="nav justify-content-center section-divider mt-4" id="tabs-<?php echo $index; ?>">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#informacion-<?php echo $index; ?>">Información</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#salud-<?php echo $index; ?>">Salud</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#mensaje-<?php echo $index; ?>">Mensajes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#presencia-<?php echo $index; ?>">Presencia</a>
                                </li>
                            </ul>

                            <div class="tab-content p-4">
                                <div class="tab-pane fade show active" id="informacion-<?php echo $index; ?>">
                                    <h3 style="text-align: left;">Información general</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="data-label">Nombre Completo</div>
                                            <div class="data-value"><?php echo $hijo["nombre"] . " " . $hijo["apellidos"]; ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-label">Fecha de Nacimiento</div>
                                            <div class="data-value">
                                                <?php
                                                $f = explode('-', $hijo["fecha_nacimiento"]);
                                                echo intval($f[2]) . ' de ' . $meses[$f[1]] . ', ' . $f[0];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-label">Género</div>
                                            <div class="data-value"><?php echo ucfirst($hijo["genero"]); ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-label">Tutor</div>
                                            <div class="data-value"><?php echo $_SESSION["usuario"]["nombre"]; ?></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="data-label">Acerca de</div>
                                            <div class="data-value"><?php echo !empty($hijo["acerca"]) ? $hijo["acerca"] : "No hay descripción"; ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-label">Grupo/Aula</div>
                                            <div class="data-value"><?php echo $hijo["nombre_aula"]; ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-label">Guardería</div>
                                            <div class="data-value"><?php echo $hijo["nombre_guarderia"]; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="salud-<?php echo $index; ?>">
                                    <p><?php echo !empty($hijo["observaciones"]) ? $hijo["observaciones"] : "No hay datos médicos registrados"; ?></p>
                                </div>

                                <div class="tab-pane fade" id="mensaje-<?php echo $index; ?>">

                                    <?php
                                    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
                                    $url = DIR_SERV . "/anotaciones_presencia/" . $hijo["id_nino"];
                                    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
                                    $json_administradores = json_decode($respuesta, true);
                                    if (!isset($json_administradores["mensaje"])) {
                                        $datos_asistencia = $json_administradores["anotaciones_presencia"];
                                    }

                                    if (isset($json_administradores["mensaje"])) {
                                        echo "<p class='text-muted'>No hay mensajes para este niño.</p>";
                                    } else {
                                    ?>
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr class="text-center">
                                                    <th>Fecha</th>
                                                    <th>Mensaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datos_asistencia as $registro): ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo htmlspecialchars($registro["fecha"]); ?></td>
                                                        <td>
                                                            <?php

                                                            if (!empty($registro["observaciones"])) {
                                                                echo htmlspecialchars($registro["observaciones"]);
                                                            } else {
                                                                echo "<span>No hay observaciones</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="tab-pane fade" id="presencia-<?php echo $index; ?>">

                                    <?php
                                    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
                                    $url = DIR_SERV . "/anotaciones_presencia/" . $hijo["id_nino"];
                                    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
                                    $json_administradores = json_decode($respuesta, true);
                                    if (!isset($json_administradores["mensaje"])) {
                                        $datos_asistencia = $json_administradores["anotaciones_presencia"];
                                    }



                                    if (isset($json_administradores["mensaje"])) {
                                        echo "<p class='text-muted'>No hay presencias para este niño.</p>";
                                    } else {
                                    ?>
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr class="text-center">
                                                    <th>Fecha</th>
                                                    <th>Presencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datos_asistencia as $registro): ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo htmlspecialchars($registro["fecha"]); ?></td>
                                                        <td class="text-center">
                                                            <?php

                                                            if (!empty($registro["presencia"])) {
                                                                echo ucfirst(htmlspecialchars($registro["presencia"]));
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
        <div class="swiper-pagination mt-3"></div>
    </div>


    <?php require 'footer.php'; ?>

</body>

</html>