<?php
require_once __DIR__ . '/../../core/Model.php';

class AsignacionDieta extends Model {
    public function listar() {
        $sql = "SELECT ad.id, u.nombre AS paciente, d.nombre AS dieta, enf.nombre AS enfermero,
                       ad.fecha_asignacion, ad.entregada, ad.fecha_entrega
                FROM asignacion_dieta ad
                JOIN paciente p ON ad.paciente_id = p.id
                JOIN usuario u ON p.usuario_id = u.id
                JOIN dieta d ON ad.dieta_id = d.id
                JOIN usuario enf ON ad.enfermero_id = enf.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($paciente_id, $dieta_id, $fecha_asignacion, $enfermero_id) {
        $stmt = $this->db->prepare("INSERT INTO asignacion_dieta (paciente_id, dieta_id, fecha_asignacion, enfermero_id)
                                    VALUES (?, ?, ?, ?)");
        return $stmt->execute([$paciente_id, $dieta_id, $fecha_asignacion, $enfermero_id]);
    }
}
