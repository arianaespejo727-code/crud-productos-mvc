<?php
session_start();
require_once __DIR__ . "/config/conexion.php";
require_once __DIR__ . "/controllers/ProductosController.php";

$controlador = new ProductosController($conexion);
$accion = $_POST["accion"] ?? $_GET["accion"] ?? "index";

switch ($accion) {
    case "crear":      $controlador->crear();      break;
    case "guardar":    $controlador->guardar();    break;
    case "editar":     $controlador->editar();     break;
    case "actualizar": $controlador->actualizar(); break;
    case "eliminar":   $controlador->eliminar();   break;
    default:           $controlador->index();      break;
}