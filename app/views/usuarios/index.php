<?php
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../app/models/Usuario.php';

$db = new Database();
$pdo = $db->connect();
$usuario = new Usuario($pdo);
$usuarios = $usuario->listarUsuarios();
?>

<div class="container">
    <h4 class="mb-3">Gestión de Usuarios</h4>

    <form method="POST" action="/sistema_nutricion/app/controllers/UsuarioController.php" class="row g-3 mb-4">
        <input type="hidden" name="accion" value="crear">
        <div class="col-md-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
        </div>
        <div class="col-md-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col-md-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="col-md-2">
            <select name="rol_id" class="form-select" required>
                <option value="">Rol</option>
                <option value="1">Admin</option>
                <option value="2">Nutricionista</option>
                <option value="3">Enfermero</option>
                <option value="4">Paciente</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100">Crear</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= $u['rol_id'] ?></td>
                    <td>
                        <form method="POST" action="/sistema_nutricion/app/controllers/UsuarioController.php" class="d-inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
