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
                     <button class="btn btn-primary" type="button" 
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarUsuario"
                            data-id="<?= $u['id'] ?>"
                            data-nombre="<?= htmlspecialchars($u['nombre']) ?>"
                            data-email="<?= htmlspecialchars($u['email']) ?>"
                            data-rol_id="<?= $u['rol_id'] ?>">
                            Editar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form method="POST" action="/sistema_nutricion/app/controllers/UsuarioController.php" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id" id="edit-id">

                <div class="mb-3">
                  <label>Nombre</label>
                  <input type="text" name="nombre" id="edit-nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label>Email</label>
                  <input type="email" name="email" id="edit-email" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label>Nueva contraseña (opcional)</label>
                  <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                </div>

                <div class="mb-3">
                  <label>Rol</label>
                  <select name="rol_id" id="edit-rol_id" class="form-select" required>
                    <option value="1">Admin</option>
                    <option value="2">Nutricionista</option>
                    <option value="3">Enfermero</option>
                    <option value="4">Paciente</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>

          <script>
      document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('modalEditarUsuario');

      modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        if (!button) {
          console.warn("No hay botón disparador.");
          return;
        }

        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const email = button.getAttribute('data-email');
        const rol_id = button.getAttribute('data-rol_id');

        console.log("Abriendo modal con datos:", { id, nombre, email, rol_id });

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nombre').value = nombre;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-rol_id').value = rol_id;
      });
    });
    </script>