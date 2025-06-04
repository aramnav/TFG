<?php

$SERVIDOR = "localhost";
$BD = "bd_gestion_guarderias";
$USUARIO = "root";
$CLAVE = "";

define("DIR_SERV", "http://localhost/ProyectoFinGrado/API_REST");


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = new mysqli($SERVIDOR, $USUARIO, $CLAVE, $BD);
    $conexion->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {

    $conexion = null;
}

function consumir_servicios_JWT_REST($url, $metodo, $headers, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    curl_setopt($llamada, CURLOPT_HTTPHEADER, $headers);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}
