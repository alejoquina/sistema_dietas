<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/AsignacionDieta.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Dieta.php';

class AsignacionDietaController extends Controller {
    public function procesar() {
        $this->isLoggedIn();
        $pdo = $this->db();
        $modelo = new AsignacionDieta($pdo);
        $usuario = new Usuario($pdo);
        $dieta = new Dieta($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'] ?? '';
            $dieta_id = $_POST['dieta_id'] ?? '';
            $enfermero_id = $_POST['enfermero_id'] ?? '';
            $fecha_asignacion = $_POST['fecha_asignacion'] ?? '';

            $usuario_data = $usuario->buscarPorEmail($correo);

            if ($usuario_data) {
                $paciente_id = $usuario_data['id'];
                $modelo->crear($paciente_id, $dieta_id, $fecha_asignacion, $enfermero_id);
                $_SESSION['mensaje'] = "Dieta asignada correctamente.";
                $_SESSION['tipo_mensaje'] = "success";
            } else {
                $_SESSION['mensaje'] = "El correo ingresado no corresponde a ningún usuario.";
                $_SESSION['tipo_mensaje'] = "danger";
            }

            header("Location: /sistema_nutricion/public/dashboard.php?view=asignaciones");
            exit;
        }
    }
}
