<?php
session_start();
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

$db = new Database();
$pdo = $db->connect();
$paciente = new Paciente($pdo);
$usuario = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $contacto = $_POST['contacto'] ?? '';

    $usuarioInfo = $usuario->buscarPorEmail($email);
    if (!$usuarioInfo) {
        $_SESSION['mensaje'] = "No se encontró un usuario con ese correo.";
        $_SESSION['tipo_mensaje'] = "danger";
    } else {
        $usuario_id = $usuarioInfo['id'];
        $yaPaciente = $paciente->buscarPorUsuarioId($usuario_id);
        if ($yaPaciente) {
            $_SESSION['mensaje'] = "Este usuario ya está registrado como paciente.";
            $_SESSION['tipo_mensaje'] = "warning";
        } else {
            $paciente->crear($usuario_id, $edad, $contacto);
            $_SESSION['mensaje'] = "Paciente registrado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
        }
    }

    header("Location: /sistema_nutricion/public/dashboard.php?view=pacientes");
    exit;
}
?>
