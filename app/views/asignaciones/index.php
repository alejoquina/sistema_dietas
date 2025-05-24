<?php
require_once __DIR__ . '/../../../app/models/AsignacionDieta.php';

$modelo = new AsignacionDieta();
$dietas = $modelo->listarDietas();
$enfermeros = $modelo->listarEnfermeros();
$asignaciones = $modelo->listar();
?>

<?php if (isset($_SESSION['mensaje'])): ?>
<div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?>">
    <?= $_SESSION['mensaje'] ?>
</div>
<?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); endif; ?>

<h4>Asignar Dieta</h4>
<form method="POST" action="/sistema_nutricion/app/controllers/AsignacionDietaController.php">
    <div class="row mb-3">
        <div class="col">
            <input type="email" name="correo" class="form-control" placeholder="Correo del paciente" required>
        </div>
        <div class="col">
            <select name="dieta_id" class="form-control" required>
                <option value="">Seleccione dieta</option>
                <?php foreach ($dietas as $d): ?>
                    <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <select name="enfermero_id" class="form-control" required>
                <option value="">Seleccione enfermero</option>
                <?php foreach ($enfermeros as $e): ?>
                    <option value="<?= $e['usuario_id'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <input type="datetime-local" name="fecha_asignacion" class="form-control" required>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Asignar</button>
        </div>
    </div>
</form>

<hr>
<h5>Asignaciones registradas</h5>
<?php if (!empty($asignaciones)) : ?>
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Dieta</th>
            <th>Enfermero</th>
            <th>Fecha asignación</th>
            <th>Entregada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($asignaciones as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['paciente']) ?></td>
            <td><?= htmlspecialchars($a['dieta']) ?></td>
            <td><?= htmlspecialchars($a['enfermero']) ?></td>
            <td><?= $a['fecha_asignacion'] ?></td>
            <td><?= $a['entregada'] ? 'Sí' : 'No' ?></td>
            <td>
                <form method="POST" action="/sistema_nutricion/app/controllers/AsignacionDietaController.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $a['id'] ?>">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta asignación?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No hay asignaciones registradas.</p>
<?php endif; ?>
