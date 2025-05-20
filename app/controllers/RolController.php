<?php
session_start();
require_once __DIR__ . '/../models/Rol.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

$db = new Database();
$pdo = $db->connect();
$rol = new Rol($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $rol->eliminar($id);
        }
    } else {
        $nombre = $_POST['nombre'] ?? '';
        $permisos = $_POST['permisos'] ?? '';

        if ($nombre && $permisos) {
            $rol->crear($nombre, $permisos);
        }
    }
}

header("Location: /sistema_nutricion/public/dashboard.php?view=roles");
exit;
