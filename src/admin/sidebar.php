<?php
// admin/sidebar.php

$current_page = basename($_SERVER['PHP_SELF']);

// ==============================
// FOTO GOOGLE o AVATAR DEFAULT
// ==============================
if (isset($_SESSION['google_picture']) && $_SESSION['google_picture'] !== null) {
    // Imagen HD
    $foto_usuario = $_SESSION['google_picture'] . '?sz=200';
} else {
    // Imagen por defecto
    $foto_usuario = '/assets/img/user.png';
}

$nombre_usuario = $_SESSION['usuario_nombre'] ?? 'Administrador';
?>

<style>
  /* Contenedor fijo y con overflow oculto */
  .user-name-wrapper {
    width: 160px;
    overflow: hidden;
    white-space: nowrap;
  }

  /* Animación de desplazamiento tipo ping-pong */
  .user-name {
    display: inline-block;
    padding-left: 0;
    animation: scroll-name 6s ease-in-out infinite alternate;
  }

  @keyframes scroll-name {
    0% { transform: translateX(0); }
    100% { transform: translateX(-65%); }
  }

  .user-name {
    font-weight: 500;
    color: #fff;
    text-overflow: ellipsis;
  }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a href="index.php" class="brand-link text-center">
    <span class="brand-text font-weight-light"><b>Dash</b>board</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="image">
        <img src="<?= htmlspecialchars($foto_usuario) ?>"
             class="img-circle elevation-2"
             alt="User Image"
             style="object-fit: cover; width: 38px; height: 38px;">
      </div>

      <div class="info">
        <div class="user-name-wrapper">
          <a href="#" class="d-block user-name">
            <?= htmlspecialchars($nombre_usuario) ?>
          </a>
        </div>
        <small class="text-success">
          <i class="fas fa-circle text-success"></i> En línea
        </small>
      </div>

    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="/admin/index.php" class="nav-link <?= $current_page == 'index.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Vendedores -->
        <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'vendedores') !== false ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'vendedores') !== false ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Vendedores<i class="right fas fa-angle-left"></i></p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/modules/vendedores/index_lista_vendedores.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index_lista_vendedores.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Lista de Vendedores</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/modules/vendedores/index_agregar_vendedor.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index_agregar_vendedor.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Agregar Vendedor</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Clientes -->
        <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'clientes') !== false ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'clientes') !== false ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Clientes <i class="right fas fa-angle-left"></i></p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/modules/clientes/index_lista_clientes.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index_lista_clientes.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Lista de Clientes</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/modules/clientes/index_agregar_cliente.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index_agregar_cliente.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Agregar Cliente</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Ventas -->
        <li class="nav-item item-des">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Ventas<i class="right fas fa-angle-left"></i></p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="../modules/ventas/nueva.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Nueva Venta</p></a></li>
            <li class="nav-item"><a href="../modules/ventas/historial.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Historial</p></a></li>
            <li class="nav-item"><a href="../modules/ventas/devoluciones.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Devoluciones</p></a></li>
          </ul>
        </li>

        <!-- Reportes -->
        <li class="nav-item item-des">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reportes<i class="right fas fa-angle-left"></i></p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="../modules/reportes/ventas.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Ventas por Período</p></a></li>
            <li class="nav-item"><a href="../modules/reportes/vendedores.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Top Vendedores</p></a></li>
            <li class="nav-item"><a href="../modules/reportes/productos.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Productos Más Vendidos</p></a></li>
          </ul>
        </li>

        <!-- Configuración -->
        <li class="nav-item item-des">
          <a href="../modules/configuracion/general.php" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Configuración</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<style>
  .item-des {
    pointer-events: none;
    opacity: 0.5;
  }
</style>
