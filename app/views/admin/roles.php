<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Asignar Rol a Usuarios</h2>

    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post">
        <div class="mb-3">
            <label>Seleccionar Usuario</label>
            <select name="usuario_id" class="form-control" required>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['id'] ?>">
                        <?= $u['nombre'] ?> (<?= $u['email'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Seleccionar Rol</label>
            <select name="rol_id" class="form-control" required>
                <option value="1">Administrador</option>
                <option value="2">Nutricionista</option>
                <option value="3">Enfermero</option>
                <option value="4">Paciente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Rol</button>
    </form>
</body>
</html>
