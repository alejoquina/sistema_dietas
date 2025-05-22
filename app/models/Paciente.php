<?php
require_once __DIR__ . '/../../core/Model.php';

class Paciente extends Model {
    public function listar() {
        $sql = "SELECT p.id, u.nombre AS nombre_usuario, p.edad, p.contacto, u.email 
                FROM paciente p 
                INNER JOIN usuario u ON u.id = p.usuario_id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $edad, $contacto) {
        $stmt = $this->db->prepare("INSERT INTO paciente (usuario_id, edad, contacto) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario_id, $edad, $contacto]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM paciente WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorUsuarioId($usuario_id) {
        $stmt = $this->db->prepare("SELECT * FROM paciente WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
