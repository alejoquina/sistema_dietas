<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Dieta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Eliminar Dieta</h2>
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>ID Dieta a eliminar</label>
            <input type="number" name="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</body>
</html>
