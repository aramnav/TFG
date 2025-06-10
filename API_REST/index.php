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

$app->get('/anotaciones_presencia/{id_usuario}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "padre") {
                echo json_encode(obtener_anotaciones_presencia($request->getAttribute("id_usuario")));
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
//**************************** VISTA USUARIOS ***********************************
$app->get('/usuarios', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_usuarios());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearUsuario', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("email");
                $datos[] = $request->getParam("contrasenya");
                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("telefono");
                $datos[] = $request->getParam("rol");


                echo json_encode(registrar_usuario($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarUsuario/{id_usuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                echo json_encode(borrar_usuario($request->getAttribute("id_usuario")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->put('/actualizarUsuario/{id_usuario}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                $datos[] = $request->getParam("email");
                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("telefono");
                $datos[] = $request->getParam("rol");
                $datos[] = $request->getAttribute("id_usuario");


                echo json_encode(actualizar_usuario($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

//**************************** VISTA NIÑOS ***********************************
$app->get('/ninos', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_ninos());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/nino/{id_nino}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_nino_id($request->getAttribute("id_nino")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/idNombreAulas', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_aulas_id_nombre());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/idNombrePadres', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_padres_id_nombre());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearNino', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("id_padre");
                $datos[] = $request->getParam("id_aula");
                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("apellidos");
                $datos[] = $request->getParam("fecha_nacimiento");
                $datos[] = $request->getParam("genero");
                $datos[] = $request->getParam("acerca");
                $datos[] = $request->getParam("observaciones");


                echo json_encode(registrar_nino($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarNino/{id_nino}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                echo json_encode(borrar_nino($request->getAttribute("id_nino")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->put('/actualizarNino/{id_nino}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("apellidos");
                $datos[] = $request->getParam("acerca");
                $datos[] = $request->getParam("observaciones");
                $datos[] = $request->getAttribute("id_nino");


                echo json_encode(actualizar_nino($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

//**************************** VISTA AULAS ***********************************
$app->get('/aulas', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_aulas());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/idNombreGuarderias', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_guarderias_id_nombre());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearAula', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("id_guarderia");
                $datos[] = $request->getParam("nombre_aula");
                $datos[] = $request->getParam("capacidad");


                echo json_encode(registrar_aula($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarAula/{id_aula}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                echo json_encode(borrar_aula($request->getAttribute("id_aula")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->get('/aula/{id_aula}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_aula_id($request->getAttribute("id_aula")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->put('/actualizarAula/{id_aula}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("nombre_aula");
                $datos[] = $request->getParam("capacidad");
                $datos[] = $request->getAttribute("id_aula");

                echo json_encode(actualizar_aula($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

//**************************** VISTA CLIENTES ***********************************
$app->get('/clientes', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_clientes());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearCliente', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("email");
                $datos[] = $request->getParam("telefono");
                $datos[] = $request->getParam("cif");
                $datos[] = $request->getParam("observaciones");


                echo json_encode(registrar_cliente($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarCliente/{id_cliente}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                echo json_encode(borrar_cliente($request->getAttribute("id_cliente")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->get('/cliente/{id_cliente}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_cliente_id($request->getAttribute("id_cliente")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->put('/actualizarCliente/{id_cliente}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("email");
                $datos[] = $request->getParam("telefono");
                $datos[] = $request->getParam("cif");
                $datos[] = $request->getParam("observaciones");
                $datos[] = $request->getAttribute("id_cliente");

                echo json_encode(actualizar_cliente($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

//**************************** VISTA GUARDERIAS ***********************************
$app->get('/guarderias', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_guarderias());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/idNombreClientes', function () {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_clientes_id_nombre());
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearGuarderia', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("id_cliente");
                $datos[] = $request->getParam("nombre_guarderia");
                $datos[] = $request->getParam("direccion");
                $datos[] = $request->getParam("telefono");

                echo json_encode(registrar_guarderia($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarGuarderia/{id_guarderia}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                echo json_encode(borrar_guarderia($request->getAttribute("id_guarderia")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->get('/guarderia/{id_guarderia}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_guarderia_id($request->getAttribute("id_guarderia")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->put('/actualizarGuarderia/{id_guarderia}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "admin") {

                $datos[] = $request->getParam("id_cliente");
                $datos[] = $request->getParam("nombre_guarderia");
                $datos[] = $request->getParam("direccion");
                $datos[] = $request->getParam("telefono");
                $datos[] = $request->getAttribute("id_guarderia");

                echo json_encode(actualizar_guarderia($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});


//VISTA DE PROFESOR
// ESTA LLAMADA PERTENECE TAMBIEN A ADMIN
$app->get('/aulas/{id_usuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "profesor" || $test["usuario"]["rol"] == "admin") {
                echo json_encode(obtener_aulas_guarderia($request->getAttribute("id_usuario")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/ninos_aula/{id_aula}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "profesor") {
                echo json_encode(obtener_ninos_aula($request->getAttribute("id_aula")));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearAsistencia', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["rol"] == "profesor") {

                $datos[] = $request->getParam("id_nino");
                $datos[] = $request->getParam("id_profesor");
                $datos[] = $request->getParam("fecha");
                $datos[] = $request->getParam("presencia");
                $datos[] = $request->getParam("observaciones");


                echo json_encode(registrar_asistencia($datos));
            } else {
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
            }
        } else {
            echo json_encode($test);
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});


$app->run();
