<?php
session_start();
$tiempo_inactividad = 600; // 30 minutos en segundos
require 'const/conexion.php';

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}
