<?php
require_once __DIR__ . '/../../core/Model.php';

class Rol extends Model {
    public function listarRoles() {
        $stmt = $this->db->query("SELECT * FROM ROL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $permisos) {
        $stmt = $this->db->prepare("INSERT INTO ROL (nombre, permisos, fecha_creacion) VALUES (?, ?, NOW())");
        return $stmt->execute([$nombre, $permisos]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM ROL WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
