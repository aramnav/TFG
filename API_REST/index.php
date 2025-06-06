<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_CTES.php";

$app = new \Slim\App;

$app->post('/token', function ($request) {

    $id_usuario = $request->getParam("id_usuario");

    echo json_encode(generar_token($id_usuario));
});

$app->get('/usuario/{id_usuario}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_usuario($request->getAttribute("id_usuario")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});


//VISTA DE PADRE
$app->get('/hijos/{id_usuario}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "padre") {
                echo json_encode(obtener_hijos($request->getAttribute("id_usuario")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

//VISTA DE ADMIN
$app->get('/administradores', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_administradores());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->run();
