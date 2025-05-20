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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistema Nutrición</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($usuario['rol_id'] == 1): ?>
          <li class="nav-item"><a class="nav-link" href="#">Usuarios</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Roles</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Reportes</a></li>
        <?php elseif ($usuario['rol_id'] == 2): ?>
          <li class="nav-item"><a class="nav-link" href="#">Asignar Dieta</a></li>
        <?php elseif ($usuario['rol_id'] == 3): ?>
          <li class="nav-item"><a class="nav-link" href="#">Pacientes</a></li>
        <?php elseif ($usuario['rol_id'] == 4): ?>
          <li class="nav-item"><a class="nav-link" href="#">Mi Dieta</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link text-danger" href="/sistema_nutricion/public/index.php?logout=true">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
