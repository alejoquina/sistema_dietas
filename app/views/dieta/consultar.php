<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Dietas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Dietas del Paciente</h2>
    <table class="table">
        <thead><tr><th>Nombre</th><th>Descripción</th><th>Fecha</th></tr></thead>
        <tbody>
        <?php foreach ($dietas as $d): ?>
            <tr>
                <td><?= $d['nombre'] ?></td>
                <td><?= $d['descripcion'] ?></td>
                <td><?= $d['fecha_asignacion'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
