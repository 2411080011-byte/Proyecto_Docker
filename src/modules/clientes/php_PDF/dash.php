<?php
session_start();
if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = 'Usuario';
}
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">

  <title>Dashboard | AdminLTE Bootstrap</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Íconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Fuente -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

  <style>
    body {
      font-family: "Source Sans 3", sans-serif;
      background-color: #f4f6f9;
      overflow-x: hidden;
    }

    /* ===== Sidebar ===== */
    #sidebar {
      width: 260px;
      background-color: #f0f1f3;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      overflow-y: auto;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-right: 1px solid #ddd;
      z-index: 1050;
    }

    #sidebar.collapsed {
      transform: translateX(-100%);
    }

    #sidebar .brand {
      background: #e7e8ea;
      padding: 1rem;
      font-weight: 600;
      font-size: 1.1rem;
      border-bottom: 1px solid #ccc;
    }

    #sidebar a.nav-link {
      color: #333;
      padding: 10px 20px;
      border-radius: 8px;
      transition: all 0.2s;
      margin: 4px 8px;
    }

    #sidebar a.nav-link:hover {
      background-color: #dee3ea;
      color: #0d6efd;
    }

    #sidebar a.nav-link.active {
      background-color: #d8def5;
      color: #0d6efd !important;
      font-weight: 600;
    }

    /* ===== Overlay (para móviles) ===== */
    #sidebarOverlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1040;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    #sidebarOverlay.show {
      display: block;
      opacity: 1;
    }

    /* ===== Main content ===== */
    #content {
      margin-left: 260px;
      transition: margin-left 0.3s ease;
      padding: 1rem;
    }

    #sidebar.collapsed+#content {
      margin-left: 0;
    }

    /* ===== Navbar ===== */
    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .navbar .nav-link {
      color: #444 !important;
      font-weight: 500;
    }

    .navbar .nav-link:hover {
      color: #0d6efd !important;
    }

    /* ===== Footer ===== */
    footer {
      background: #ffffff;
      border-top: 1px solid #ddd;
      padding: 0.75rem 1rem;
      color: #666;
      text-align: center;
    }

    /* ===== Responsividad ===== */
    @media (max-width: 992px) {
      #sidebar {
        transform: translateX(-100%);
        position: fixed;
        box-shadow: none;
      }

      #sidebar.show {
        transform: translateX(0);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
      }

      #content {
        margin-left: 0 !important;
      }

      #toggleSidebar {
        display: inline-block;
      }
    }
  </style>
</head>

<body>

  <!-- Overlay para móviles -->
  <div id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div id="sidebar">
    <div class="brand d-flex align-items-center">
      <img src="imagen.jpg" alt="logo" class="rounded-circle me-2" width="40" height="40">
      <span>Dashboard</span>
    </div>
    <nav class="mt-3">
      <ul class="nav flex-column">
        <li><a href="#" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Panel</a></li>
        <li><a href="../tailwind.php" class="nav-link"><i class="bi bi-layers me-2"></i> Tailwind</a></li>
        <li><a href="../boostrap.php" class="nav-link"><i class="bi bi-bootstrap me-2"></i> Bootstrap</a></li>
        <li><a href="../index.php" class="nav-link"><i class="bi bi-box-arrow-right me-2"></i> Salir</a></li>
      </ul>
    </nav>
  </div>

  <!-- Contenido principal -->
  <div id="content">
    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <button id="toggleSidebar" class="btn btn-outline-secondary me-3">
          <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand fw-bold" href="#">Inicio</a>

        <div class="ms-auto d-flex align-items-center">
          <img src="imagen.jpg" class="rounded-circle me-2" width="40" height="40" alt="User">
          <span class="fw-semibold">Bienvenido <?php echo $_SESSION["username"]; ?></span>
        </div>
      </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="mt-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <?php include 'index.php'; ?>
        </div>
      </div>
    </main>

    <footer class="mt-4">
      <strong>&copy; 2025 <a href="https://adminlte.io">AdminLTE.io</a></strong> — Todos los derechos reservados.
    </footer>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.getElementById("sidebar");
      const toggleButton = document.getElementById("toggleSidebar");
      const overlay = document.getElementById("sidebarOverlay");

      toggleButton.addEventListener("click", () => {
        const isMobile = window.innerWidth <= 992;

        if (isMobile) {
          sidebar.classList.toggle("show");
          overlay.classList.toggle("show");
        } else {
          sidebar.classList.toggle("collapsed");
        }
      });

      overlay.addEventListener("click", () => {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
      });
    });
  </script>

</body>

</html>