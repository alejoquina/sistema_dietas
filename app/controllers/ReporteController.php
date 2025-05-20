<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Dieta.php';

class ReporteController extends Controller {
    public function generar() {
        $dieta = new Dieta();
        $reporte = $dieta->obtenerReporteGeneral();
        $this->view('reporte/generar', ['reporte' => $reporte]);
    }
}
?>
