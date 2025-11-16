<?php
// admin/navbar.php
require_once __DIR__ . '/../includes/config.php';

//checkAuth();
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/src/admin/index.php" class="nav-link">Inicio</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Soporte</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notificaciones</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 solicitudes de amistad
          <span class="float-right text-muted text-sm">12 horas</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
      </div>
    </li>

    <!-- User Account Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link usuario-navbar" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i>
        <span class="usuario-nombre"><?php echo $_SESSION['usuario_nombre'] ?? 'Usuario'; ?></span>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header text-center">
          <img src="/src/assets/img/user-avatar.jpg" class="img-circle elevation-2" alt="User Image" width="58" height="65">
          <p class="mt-2">
            <?php echo $_SESSION['usuario_nombre'] ?? 'Administrador'; ?>
            <small>Miembro desde <?php echo date('M. Y'); ?></small>
          </p>
        </span>

        <div class="dropdown-divider"></div>
        <a href="profile.php" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Mi Perfil
        </a>
        <a href="settings.php" class="dropdown-item">
          <i class="fas fa-cog mr-2"></i> Configuración
        </a>
        <div class="dropdown-divider"></div>
        <a href="/src/logout.php" class="dropdown-item text-danger">
          <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
        </a>
      </div>
    </li>

    <!-- Fullscreen Toggle -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>

<!-- /.navbar -->

<style>
/* Centrado vertical del nombre junto al icono */
.usuario-navbar {
  display: flex;
  align-items: center; /* centra verticalmente */
}

.usuario-navbar .usuario-nombre {
  margin-left: 5px;
  display: inline-block;
  vertical-align: middle;
  white-space: nowrap; /* por defecto una línea */
}

/* Para móviles: permitir máximo 2 líneas y envolver el texto */
@media (max-width: 576px) {
  .usuario-navbar .usuario-nombre {
    white-space: normal; /* permite salto de línea */
    display: -webkit-box;
    -webkit-line-clamp: 2; /* máximo 2 líneas */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>
