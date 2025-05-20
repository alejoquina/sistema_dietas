<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class AdminController extends Controller {
    public function roles() {
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->asignarRol($_POST['usuario_id'], $_POST['rol_id']);
            $this->view('admin/roles', [
                'usuarios' => $usuario->listarUsuarios(),
                'success' => 'Rol asignado correctamente.'
            ]);
        } else {
            $this->view('admin/roles', [
                'usuarios' => $usuario->listarUsuarios()
            ]);
        }
    }
}
?>
