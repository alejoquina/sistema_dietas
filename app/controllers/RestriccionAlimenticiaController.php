<?php
session_start();
require_once __DIR__ . '/../models/RestriccionAlimenticia.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

$db = new Database();
$pdo = $db->connect();
$restriccion = new RestriccionAlimenticia($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $restriccion->eliminar($id);
        }
    } else {
        $descripcion = $_POST['descripcion'] ?? '';
        if ($descripcion) {
            $restriccion->crear($descripcion);
        }
    }
}

header("Location: /sistema_nutricion/public/dashboard.php?view=restricciones");
exit;
