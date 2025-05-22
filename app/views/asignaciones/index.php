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
            <input type="number" name="dieta_id" class="form-control" placeholder="ID Dieta" required>
        </div>
        <div class="col">
            <input type="number" name="enfermero_id" class="form-control" placeholder="ID Enfermero" required>
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
            <th>ID</th>
            <th>Paciente</th>
            <th>Dieta</th>
            <th>Enfermero</th>
            <th>Fecha Asignación</th>
            <th>Entregada</th>
            <th>Fecha Entrega</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($asignaciones as $a): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= htmlspecialchars($a['paciente']) ?></td>
            <td><?= htmlspecialchars($a['dieta']) ?></td>
            <td><?= htmlspecialchars($a['enfermero']) ?></td>
            <td><?= $a['fecha_asignacion'] ?></td>
            <td><?= $a['entregada'] ? 'Sí' : 'No' ?></td>
            <td><?= $a['fecha_entrega'] ?? '-' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p class="text-muted">No hay asignaciones registradas.</p>
<?php endif; ?>
