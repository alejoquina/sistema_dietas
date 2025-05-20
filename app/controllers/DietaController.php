<?php
session_start();
require_once __DIR__ . '/../models/Dieta.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

$db = new Database();
$pdo = $db->connect();
$dieta = new Dieta($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $dieta->eliminar($_POST['id']);
        $_SESSION['mensaje'] = "Dieta eliminada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        if ($nombre && $descripcion) {
            $dieta->crear($nombre, $descripcion);
            $_SESSION['mensaje'] = "Dieta creada correctamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Debe completar todos los campos.";
            $_SESSION['tipo_mensaje'] = "danger";
        }
    }
}

header("Location: /sistema_nutricion/public/dashboard.php?view=dietas");
exit;
