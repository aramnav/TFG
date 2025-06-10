<?php
session_start();
$tiempo_inactividad = 900; // 15 minutos en segundos
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
$url = DIR_SERV . "/aulas/" . $_SESSION["usuario"]["id_usuario"];
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_aulas = json_decode($respuesta, true);

$aulas = $json_aulas['aulas'];
$contador = 1;




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Profesor</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>

</style>

<body>
    <?php require 'header.php'; ?>

    <h1>Registrar Asistencia</h1>

    <div class="container mt-4">
        <form method="post" class="mb-4">
            <label for="aula" class="form-label">Selecciona Aula</label>
            <select name="aula" id="aula" class="form-select w-50" required>
                <?php foreach ($aulas as $aula): ?>
                    <option value="<?php echo htmlspecialchars($aula['id_aula']); ?>"
                        <?php if (isset($_POST['aula']) && $_POST['aula'] == $aula['id_aula']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($aula['nombre_aula']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn mt-2" style="background-color: #12578e; color: white;">Seleccionar aula</button>
        </form>
        <?php echo isset($_SESSION["mensaje"]) ? $_SESSION["mensaje"] : ""; ?>

        <?php
        if (!empty($_POST["aula"])) {
            $headers[] = "Authorization: Bearer " . $_SESSION["token"];
            $url = DIR_SERV . "/ninos_aula/" . urlencode($_POST["aula"]);
            $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
            $json_ninos_aula = json_decode($respuesta, true);

            if (isset($json_ninos_aula["ninos_aula"]) && is_array($json_ninos_aula["ninos_aula"])) {
                $ninos_aula = $json_ninos_aula["ninos_aula"];
                if (count($ninos_aula) > 0) : ?>
                    <form method="post">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Falta</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ninos_aula as $nino): ?>
                                    <tr>
                                        <td><?php echo $contador++; ?></td>
                                        <td style="padding-left: 20px;"><?php echo htmlspecialchars($nino['nombre'] . " " . $nino['apellidos']); ?></td>
                                        <td class="text-center">
                                            <input type="checkbox" name="asistencia[]" value="<?php echo $nino['id_nino']; ?>">
                                        </td>
                                        <td><input type="text" name="observaciones[<?php echo $nino['id_nino']; ?>]" class="form-control" placeholder="Observaciones"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" name="guardar_lista" class="btn mt-5" style="background-color: #12578e; color: white;">Guardar Lista</button>
                        <input type="hidden" name="aula" value="<?php echo $_POST["aula"]; ?>">
                    </form>
                <?php else: ?>
                    <div class="alert alert-info">No hay niños registrados en esta aula.</div>
        <?php endif;
            } else {
                echo '<div class="alert alert-danger">Error al obtener los datos de los niños.</div>';
            }
        }
        ?>
    </div>

    <?php

    if (isset($_POST['guardar_lista'])) {

        $asistencia = $_POST['asistencia'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        $fecha = date('Y-m-d');
        $id_profesor = $_SESSION['usuario']["id_usuario"];


        foreach ($ninos_aula as $nino) {
            $id_nino = $nino['id_nino'];

            // Si el checkbox está marcado, está ausente
            $estado_asistencia = in_array($id_nino, $asistencia) ? "ausente" : "presente";

            $observacion = $observaciones[$id_nino] ?? '';


            $headers[] = "Authorization: Bearer " . $_SESSION["token"];
            $url = DIR_SERV . "/crearAsistencia";
            $datos = [
                "id_nino" => $id_nino,
                "id_profesor" => $id_profesor,
                "fecha" => $fecha,
                "presencia" => $estado_asistencia,
                "observaciones" => $observacion
            ];
            $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos);
            $json_respuesta = json_decode($respuesta, true);
        }

        $_SESSION["mensaje"] = '<div class="alert alert-info" style="margin-top: 20px;">Asistencia registrada correctamente.</div>';
    }


    ?>


    <?php require 'footer.php'; ?>
</body>

</html>