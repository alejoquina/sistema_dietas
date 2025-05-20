<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $usuarioModel = new Usuario();
            $user = $usuarioModel->buscarPorEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['usuario'] = [
                    'id' => $user['id'],
                    'nombre' => $user['nombre'],
                    'email' => $user['email'],
                    'rol_id' => $user['rol_id'],
                ];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Credenciales incorrectas";
                include __DIR__ . '/../views/auth/login.php';
            }
        } else {
            include __DIR__ . '/../views/auth/login.php';
        }
    }
}
