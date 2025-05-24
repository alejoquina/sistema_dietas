<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

$db = new Database();
$pdo = $db->connect();
$usuario = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'eliminar') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $usuario->eliminar($id);
        }

    } elseif ($accion === 'editar') {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol_id = $_POST['rol_id'] ?? 4;

        // Solo hashea si el campo contraseña no está vacío
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = null;
        }

        if ($id && $nombre && $email && $rol_id) {
            $usuario->editar($id, $nombre, $email, $password, $rol_id);
        }

    } else {
        // Acción por defecto: crear
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol_id = $_POST['rol_id'] ?? 4;

        if ($nombre && $email && $password && $rol_id) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $usuario->crear($nombre, $email, $password, $rol_id);
        }
    }
}

header("Location: /sistema_nutricion/public/dashboard.php?view=usuarios");
exit;
