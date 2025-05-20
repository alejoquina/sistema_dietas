<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Dieta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Asignar Dieta</h2>
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>ID del paciente</label>
            <input type="number" name="paciente_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Dieta</label>
            <select name="dieta_id" class="form-control">
                <?php foreach ($dietas as $d) echo "<option value='{$d['id']}'>{$d['nombre']}</option>"; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>ID del enfermero</label>
            <input type="number" name="enfermero_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
</body>
</html>
