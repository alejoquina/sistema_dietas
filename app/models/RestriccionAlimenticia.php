<?php
require_once __DIR__ . '/../../core/Model.php';

class RestriccionAlimenticia extends Model {
    public function listar() {
        $stmt = $this->db->query("SELECT * FROM RESTRICCION_ALIMENTICIA");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($descripcion) {
        $stmt = $this->db->prepare("INSERT INTO RESTRICCION_ALIMENTICIA (descripcion, fecha_creacion) VALUES (?, NOW())");
        return $stmt->execute([$descripcion]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM RESTRICCION_ALIMENTICIA WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
