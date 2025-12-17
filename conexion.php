<?php
$host = "localhost";
$usuario = "root";
$password = "";
$basedatos = "sitio_fisica";
$puerto = 33065;

$conexion = new mysqli(
    $host,
    $usuario,
    $password,
    $basedatos,
    $puerto
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$conexion->set_charset("utf8");
