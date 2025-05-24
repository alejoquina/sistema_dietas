<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    header("Location: /sistema_nutricion/public/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel principal</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.css" rel="stylesheet">
    <!-- Bootstrap JS (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <style>
        body { display: flex; height: 100vh; }
        .sidebar {
            width: 250px; background-color: #f8f9fa; padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #333; display: flex; align-items: center; gap: 8px; cursor: pointer;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
        .content {
            flex-grow: 1; padding: 20px; overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-3 shadow-sm">
             <div class="text-center">
                <img src="/sistema_nutricion/img/logo2.png" alt="Logo" style="height: 100px; margin-bottom: 5px;">
              </div>
        <h4 class="text-center mb-4">Panel <?= htmlspecialchars($usuario['nombre']) ?></h4>
        <span class="text-muted text-center mb-3">Usuario: <?= htmlspecialchars($usuario['email']) ?></span>

        <?php if ($usuario['rol_id'] == 1): ?>
            <a class="nav-link" data-view="usuarios"><i data-lucide="users"></i> Gestión de Usuarios</a>
            <a class="nav-link" data-view="roles"><i data-lucide="user-cog"></i> Gestión de Roles</a>
            <a class="nav-link" data-view="restricciones"><i data-lucide="apple"></i> Restricciones Alimenticias</a>
            <a class="nav-link" data-view="pacientes"><i data-lucide="user-plus"></i> Registro de Pacientes</a>
            <a class="nav-link" data-view="dietas"><i data-lucide="utensils-crossed"></i> Gestión de Dietas</a>
            <a class="nav-link" data-view="asignaciones"><i data-lucide="send"></i> Asignación de Dietas</a>
            <a class="nav-link" data-view="reportes"><i data-lucide="file-text"></i> Reportes</a>
            <a class="nav-link" data-view="confirmaciones"><i data-lucide="check-square"></i> Confirmación de Entrega</a>
        <?php elseif ($usuario['rol_id'] == 2): ?>
            <a class="nav-link" data-view="nutricionista"><i data-lucide="utensils-crossed"></i> Panel Nutricionista</a>
        <?php elseif ($usuario['rol_id'] == 3): ?>
            <a class="nav-link" data-view="enfermero"><i data-lucide="shield-check"></i> Panel Enfermero</a>
    
<?php elseif ($usuario['rol_id'] == 4): ?>
            <a class="nav-link" data-view="perfil"><i data-lucide="user"></i> Mi Perfil</a>
            <a class="nav-link" data-view="dieta_personal"><i data-lucide="utensils"></i> Mi Dieta</a>
            <a class="nav-link" data-view="confirmar_entrega"><i data-lucide="check-circle"></i> Confirmar Entrega</a>
            <a class="nav-link" data-view="mis_reportes"><i data-lucide="file-text"></i> Mis Reportes</a>
        <?php endif; ?>

        <hr>
        <a href="/sistema_nutricion/public/index.php?logout=true" class="nav-link text-danger"><i data-lucide="log-out"></i> Cerrar sesión</a>
    </div>

    <div class="content" id="contenido">
        <h3>Panel de <?= htmlspecialchars($usuario['nombre']) ?></h3>
        <p>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?>. Seleccione una opción del menú para comenzar.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
    lucide.createIcons();

    document.querySelectorAll('.nav-link[data-view]').forEach(link => {
        link.addEventListener('click', () => {
            const view = link.getAttribute('data-view');
            fetch(`/sistema_nutricion/app/views/${view}/index.php`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('contenido').innerHTML = html;
                    lucide.createIcons();

                    // ⬇️ Volver a activar el evento del modal después de cargar el módulo
                    const modal = document.getElementById('modalEditarUsuario');
                    if (modal) {
                        modal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            if (!button) return;

                            const id = button.getAttribute('data-id');
                            const nombre = button.getAttribute('data-nombre');
                            const email = button.getAttribute('data-email');
                            const rol_id = button.getAttribute('data-rol_id');

                            document.getElementById('edit-id').value = id;
                            document.getElementById('edit-nombre').value = nombre;
                            document.getElementById('edit-email').value = email;
                            document.getElementById('edit-rol_id').value = rol_id;
                        });
                    }
                }).catch(() => {
                    document.getElementById('contenido').innerHTML = "<p class='text-danger'>No se pudo cargar el módulo.</p>";
                });
        });
    });
</script>

    </script>
    <!-- Bootstrap JS para que funcionen los modales -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
