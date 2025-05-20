<?php
require_once __DIR__ . '/../../core/Model.php';

class Usuario extends Model {
    public function buscarPorEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $email, $password, $rol_id) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO USUARIO (nombre, email, password, rol_id, fecha_creacion, ultima_actualizacion)
                                    VALUES (?, ?, ?, ?, NOW(), NOW())");
        return $stmt->execute([$nombre, $email, $hash, $rol_id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM USUARIO WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listarUsuarios() {
        $stmt = $this->db->query("SELECT id, nombre, email, rol_id FROM USUARIO");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
