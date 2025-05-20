<?php
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../app/models/Rol.php';

$db = new Database();
$pdo = $db->connect();
$rol = new Rol($pdo);
$roles = $rol->listarRoles();
?>

<div class="container">
    <h4 class="mb-3">Gestión de Roles</h4>

    <form method="POST" action="/sistema_nutricion/app/controllers/RolController.php" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Rol" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="permisos" class="form-control" placeholder="Permisos del Rol" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Crear</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Permisos</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $r): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['nombre']) ?></td>
                    <td><?= htmlspecialchars($r['permisos']) ?></td>
                    <td>
                        <form method="POST" action="/sistema_nutricion/app/controllers/RolController.php" class="d-inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar rol?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
