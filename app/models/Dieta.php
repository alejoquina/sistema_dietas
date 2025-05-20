<?php
require_once __DIR__ . '/../../core/Model.php';

class Dieta extends Model {
    public function listar() {
        $stmt = $this->db->query("SELECT * FROM dieta");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO dieta (nombre, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
        return $stmt->execute([$nombre, $descripcion]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM dieta WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
