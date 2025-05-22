<?php
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../app/models/RestriccionAlimenticia.php';

$db = new Database();
$pdo = $db->connect();
$restriccion = new RestriccionAlimenticia($pdo);
$lista = $restriccion->listar();
?>

<div class="container">
    <h4 class="mb-3">Restricciones Alimenticias</h4>

    <form method="POST" action="/sistema_nutricion/app/controllers/RestriccionAlimenticiaController.php" class="row g-3 mb-4">
        <div class="mb-3">
            <input type="text" name="tipo" class="form-control" placeholder="tipo alimento" required>
        </div>
        <div class="mb-3">
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción de la restricción" required>
        </div>
        <div class="mb-3">
            <input type="text" name="alimentos_prohibidos" class="form-control" placeholder="alimentos prohibidos" required>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary w-100">Agregar</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Alimentos prohibidos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['tipo']) ?></td>
                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                    <td><?= htmlspecialchars($item['alimentos_prohibidos']) ?></td>
                    <td>
                        <form method="POST" action="/sistema_nutricion/app/controllers/RestriccionAlimenticiaController.php" class="d-inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
