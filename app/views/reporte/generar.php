<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Dietas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Reporte General de Dietas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Dieta</th>
                <th>Tipo</th>
                <th>Fecha de Asignación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $r): ?>
                <tr>
                    <td><?= $r['paciente'] ?></td>
                    <td><?= $r['dieta'] ?></td>
                    <td><?= $r['tipo'] ?></td>
                    <td><?= $r['fecha_asignacion'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
