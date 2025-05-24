<?php
session_start();

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Enfermero.php';
require_once __DIR__ . '/../models/AsignacionDieta.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /sistema_nutricion/public/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $dieta_id = $_POST['dieta_id'] ?? '';
    $enfermero_usuario_id = $_POST['enfermero_id'] ?? '';
    $fecha_asignacion = $_POST['fecha_asignacion'] ?? '';

    $usuarioModel = new Usuario();
    $pacienteModel = new Paciente();
    $enfermeroModel = new Enfermero();
    $asignacionDietaModel = new AsignacionDieta();

    $usuarioData = $usuarioModel->buscarPorEmail($correo);

    if ($usuarioData) {
        $pacienteData = $pacienteModel->buscarPorUsuarioId($usuarioData['id']);

        if ($pacienteData) {
            $paciente_id = $pacienteData['id'];

            $enfermero = $enfermeroModel->buscarPorUsuarioId($enfermero_usuario_id);
            if (!$enfermero) {
                $_SESSION['mensaje'] = "El usuario seleccionado no está registrado como enfermero.";
                $_SESSION['tipo_mensaje'] = "danger";
                header("Location: /sistema_nutricion/public/dashboard.php?view=asignaciones");
                exit;
            }

            $enfermero_id = $enfermero['id'];

            $crear = $asignacionDietaModel->crear($paciente_id, $dieta_id, $fecha_asignacion, $enfermero_id);

            if ($crear) {
                $_SESSION['mensaje'] = "Dieta asignada correctamente.";
                $_SESSION['tipo_mensaje'] = "success";
            } else {
                $_SESSION['mensaje'] = "No se pudo asignar la dieta.";
                $_SESSION['tipo_mensaje'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "El usuario no está registrado como paciente.";
            $_SESSION['tipo_mensaje'] = "danger";
        }
    } else {
        $_SESSION['mensaje'] = "El correo ingresado no corresponde a ningún usuario.";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    header("Location: /sistema_nutricion/public/dashboard.php?view=asignaciones");
    exit;
}
