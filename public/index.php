<?php
session_start();
$accion = $_GET['accion'] ?? null;

if ($accion === 'crear_usuario') {
    require_once __DIR__ . '/../app/controllers/UsuarioController.php';
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

require_once __DIR__ . '/../app/controllers/AuthController.php';
$controller = new AuthController();
$controller->login();
