<?php
include_once 'Cliente.php';

$database = new Database();
$db = $database->getConnection();
$cliente = new Cliente($db);

$mensaje = '';
$tipo_mensaje = ''; // success o error

$cliente->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado.');

if ($cliente->leerUno()) {
  if ($_POST) {
    $cliente->nombre = $_POST['nombre'];
    $cliente->email = $_POST['email'];
    $cliente->telefono = $_POST['telefono'];
    $cliente->direccion = $_POST['direccion'];

    if ($cliente->actualizar()) {
      $mensaje = 'Cliente actualizado exitosamente.';
      $tipo_mensaje = 'success';
    } else {
      $mensaje = 'No se pudo actualizar el cliente.';
      $tipo_mensaje = 'danger';
    }
  }
} else {
  die('Cliente no encontrado.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Cliente</title>

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      background-color: #f4f6f9;
    }

    .main-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 88vh;
    }

    .card {
      width: 380px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .card-primary:not(.card-outline)>.card-header {
      background-color: #007bff;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      text-align: center;
    }

    .btn {
      border-radius: 6px;
    }

    /* 🔔 Estilos del toast */
    #toast-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
    }

    .toast {
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 8px;
      padding: 10px 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      animation: fadeInOut 4s ease forwards;
      font-weight: 500;
      min-width: 250px;
    }

    .toast i {
      color: white !important;
      margin-right: 5px;
    }

    .toast.success {
      border-left: 6px solid #28a745;
    }

    .toast.danger {
      border-left: 6px solid #dc3545;
    }

    @keyframes fadeInOut {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      10%,
      90% {
        opacity: 1;
        transform: translateY(0);
      }

      100% {
        opacity: 0;
        transform: translateY(20px);
      }
    }
  </style>
</head>

<body class="hold-transition login-page" style="background-color: #f4f6f9;">

  <div class="main-container">
    <div class="card card-primary">
      <div class="card-header">
        <h4><i class="fas fa-user-edit me-2"></i> Editar Cliente</h4>
      </div>

      <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$cliente->id}"); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre completo"
              value="<?php echo htmlspecialchars($cliente->nombre); ?>" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo electrónico"
              value="<?php echo htmlspecialchars($cliente->email); ?>" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="telefono" class="form-control" placeholder="Teléfono"
              value="<?php echo htmlspecialchars($cliente->telefono); ?>">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-phone"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <textarea name="direccion" class="form-control" rows="2" placeholder="Dirección completa"><?php echo htmlspecialchars($cliente->direccion); ?></textarea>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 mb-2">
              <button type="submit" class="btn btn-primary btn-block w-100">
                <i class="fas fa-save me-1"></i> Actualizar Cliente
              </button>
            </div>
            <div class="col-12">
              <a href="index_lista_clientes.php" class="btn btn-secondary btn-block w-100">
                <i class="fas fa-list mr-1"></i> Ir a Lista de Clientes</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Contenedor de toasts -->
  <div id="toast-container"></div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (!empty($mensaje)): ?>
        const container = document.getElementById("toast-container");
        const toast = document.createElement("div");
        toast.className = "toast <?php echo $tipo_mensaje; ?>";
        toast.innerHTML = `
            <i class="fas fa-<?php echo $tipo_mensaje === 'success' ? 'check-circle text-success' : 'exclamation-circle text-danger'; ?> me-2"> </i>
            <?php echo $mensaje; ?>
        `;
        container.appendChild(toast);

        // Eliminar el toast después de 4 segundos
        setTimeout(() => toast.remove(), 4000);
      <?php endif; ?>
    });
  </script>

</body>

</html>