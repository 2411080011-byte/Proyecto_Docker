<?php
include_once 'Cliente.php';

$database = new Database();
$db = $database->getConnection();
$cliente = new Cliente($db);

$mensaje = '';
$tipo_mensaje = ''; // success o danger

if ($_POST) {
  $cliente->nombre = $_POST['nombre'];
  $cliente->email = $_POST['email'];
  $cliente->telefono = $_POST['telefono'];
  $cliente->direccion = $_POST['direccion'];

  if ($cliente->crear()) {
    $mensaje = 'Cliente creado exitosamente.';
    $tipo_mensaje = 'success';
  } else {
    $mensaje = 'No se pudo crear el cliente.';
    $tipo_mensaje = 'danger';
  }
}
?>

<style>
html, body {
  height: 100%;
  margin: 0;
  background-color: #f4f6f9;
}

/* Centrado solo en pantallas medianas y grandes */
.main-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 89vh;
  padding: 20px;
}

.card {
  width: 380px; /* tamaño compacto tipo login */
  max-width: 100%;
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
}

.card-primary:not(.card-outline) > .card-header {
  background-color: #007bff;
  color: white;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  text-align: center;
}

.btn {
  border-radius: 6px;
}

textarea {
  resize: none;
}

/* Estilos del toast */
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
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  animation: fadeInOut 4s ease forwards;
  font-weight: 500;
  min-width: 250px;
}

.toast.success {
  border-left: 6px solid #28a745;
  background-color: #28a745;
  color: white;
}

.toast.danger {
  border-left: 6px solid #dc3545;
  background-color: #dc3545;
  color: white;
}

@keyframes fadeInOut {
  0% {opacity: 0; transform: translateY(20px);}
  10%, 90% {opacity: 1; transform: translateY(0);}
  100% {opacity: 0; transform: translateY(20px);}
}

/* MEDIA QUERY: para móviles, desactivar centrado vertical */
@media (max-width: 576px) {
  .main-container {
    align-items: flex-start; /* no centrado vertical */
    padding: 40px 0px;
  }
}
</style>

<div class="main-container">
  <div class="card card-primary">
    <div class="card-header">
      <h4><i class="fas fa-user-plus mr-2"></i>Crear Nuevo Cliente</h4>
    </div>

    <div class="card-body">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-phone"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <textarea name="direccion" class="form-control" rows="2" placeholder="Dirección completa"></textarea>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-save mr-1"></i> Crear Cliente
            </button>
          </div>
          <div class="col-12">
            <a href="index_lista_clientes.php" class="btn btn-secondary btn-block">
              <i class="fas fa-list mr-1"></i> Ir a Lista de Clientes
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Contenedor de toasts -->
<div id="toast-container"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  <?php if (!empty($mensaje)): ?>
    const container = document.getElementById("toast-container");
    const toast = document.createElement("div");
    toast.className = "toast <?php echo $tipo_mensaje; ?>";
    toast.innerHTML = `
        <i class="fas fa-<?php echo $tipo_mensaje === 'success' ? 'check-circle' : 'exclamation-circle'; ?>" 
           style="color: white; margin-right: 10px;"></i>
        <?php echo $mensaje; ?>
    `;
    container.appendChild(toast);

    // Eliminar el toast después de 4 segundos
    setTimeout(() => toast.remove(), 4000);
  <?php endif; ?>
});
</script>
