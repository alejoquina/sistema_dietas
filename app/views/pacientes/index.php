<?php
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../app/models/Paciente.php';

$db = new Database();
$pdo = $db->connect();
$paciente = new Paciente($pdo);
$lista = $paciente->listar();
?>

<div class="container">
    <h4 class="mb-3">Registro de Pacientes</h4>

    <?php if (!empty($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?? 'info' ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje']; unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="/sistema_nutricion/app/controllers/PacienteController.php" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="email" name="email" class="form-control" placeholder="Correo del usuario" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="edad" class="form-control" placeholder="Edad" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="contacto" class="form-control" placeholder="Contacto" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nombre_usuario']) ?></td>
                <td><?= $p['edad'] ?></td>
                <td><?= htmlspecialchars($p['contacto']) ?></td>
                <td><?= htmlspecialchars($p['email']) ?></td>
                <td>
                    <form method="POST" action="/sistema_nutricion/app/controllers/PacienteController.php" class="d-inline">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar paciente?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
