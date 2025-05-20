<?php
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../app/models/Dieta.php';

$db = new Database();
$pdo = $db->connect();
$dieta = new Dieta($pdo);
$lista = $dieta->listar();
?>

<div class="container">
    <h4 class="mb-3">Gestión de Dietas</h4>

    <?php if (!empty($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?? 'info' ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje']; unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="/sistema_nutricion/app/controllers/DietaController.php" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre de la dieta" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Crear</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acción</th></tr></thead>
        <tbody>
        <?php foreach ($lista as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><?= htmlspecialchars($d['nombre']) ?></td>
                <td><?= htmlspecialchars($d['descripcion']) ?></td>
                <td>
                    <form method="POST" action="/sistema_nutricion/app/controllers/DietaController.php" onsubmit="return confirm('¿Eliminar dieta?');">
                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
