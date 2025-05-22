<?php
require_once __DIR__ . '/../../core/Model.php';

class RestriccionAlimenticia extends Model {
    public function listar() {
        $stmt = $this->db->query("SELECT * FROM RESTRICCION_ALIMENTICIA");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($tipo,$descripcion,$restricion) {

        $stmt = $this->db->prepare("INSERT INTO RESTRICCION_ALIMENTICIA (tipo,descripcion,alimentos_prohibidos,fecha_creacion) VALUES (?,?,?, NOW())");
        return $stmt->execute([$tipo, $descripcion, $restricion]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM RESTRICCION_ALIMENTICIA WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
