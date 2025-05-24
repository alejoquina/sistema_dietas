<?php
require_once __DIR__ . '/../../core/Model.php';

class Enfermero extends Model {
   public function buscarPorUsuarioId($usuario_id) {
    $stmt = $this->db->prepare("SELECT * FROM enfermero WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>
