<?php
// Crear instancia de conexión
$db = new Database();
$pdo = $db->getConnection();

// ===============================
// GUARDAR NUEVO VENDEDOR
// ===============================
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vendedor = trim($_POST['vendedor']);
    $direccion = trim($_POST['direccion']);
    $fecha = trim($_POST['fecha']);

    if (!empty($vendedor) && !empty($direccion) && !empty($fecha)) {
        try {
            $sql = "INSERT INTO ventas (vendedor, direccion, fecha) VALUES (:vendedor, :direccion, :fecha)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':vendedor' => $vendedor,
                ':direccion' => $direccion,
                ':fecha' => $fecha
            ]);
            $mensaje = "Vendedor agregado correctamente ✅";
        } catch (PDOException $e) {
            $mensaje = "Error al guardar: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor complete todos los campos ⚠️";
    }
}
?>

<!-- Contenedor centrado -->
<div class="main-container">
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="background: #ffffff; max-width: 420px; width: 100%;">

    <!-- ENCABEZADO -->
    <div class="card-header py-4 px-4 text-center"
         style="background: linear-gradient(135deg, #dbeafe, #eff6ff); border-bottom: 2px solid #38bdf8;">
      <h4 class="fw-bold mb-0 text-primary">
        <i class="fa-solid fa-user-plus me-2 text-info"></i> Nuevo Vendedor
      </h4>
      <p class="text-muted small mb-0">Complete los datos para registrar</p>
    </div>

    <!-- CUERPO FORMULARIO -->
    <div class="card-body px-4 py-3">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-solid fa-user-tie me-1 text-info"></i> Nombre del Vendedor
          </label>
          <input type="text" name="vendedor" class="form-control rounded-3 shadow-sm" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-solid fa-map-location-dot me-1 text-danger"></i> Dirección
          </label>
          <input type="text" name="direccion" class="form-control rounded-3 shadow-sm" placeholder="Ingrese la dirección" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-regular fa-calendar-days me-1 text-primary"></i> Fecha
          </label>
          <input type="date" name="fecha" class="form-control rounded-3 shadow-sm" required>
        </div>

        <!-- BOTONES -->
        <div class="d-flex justify-content-between mt-4">
          <button type="submit" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
          </button>
          <a href="/src/modules/vendedores/index_lista_vendedores.php" class="btn btn-info shadow-sm text-white">
            <i class="fa-solid fa-list me-1"></i> Lista de Vendedores
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if (!empty($mensaje)): ?>
  <div class="alerta-flotante">
    <?= htmlspecialchars($mensaje) ?>
  </div>

  <script>
    setTimeout(() => {
      const alerta = document.querySelector('.alerta-flotante');
      if (alerta) alerta.remove();
    }, 3000);
  </script>
<?php endif; ?>

<style>
body {
  background-color: #f4f6f9 !important;
  font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
  height: 100%;
  margin: 0;
}

/* Contenedor centrado vertical y horizontal */
.main-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 86vh;
  padding: 20px;
}

/* Tarjeta del formulario */
.card {
  border-radius: 1rem !important;
  transition: 0.3s ease-in-out;
}
.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* Inputs */
.form-control:focus {
  border-color: #38bdf8 !important;
  box-shadow: 0 0 0 0.25rem rgba(56,189,248,0.25) !important;
}

/* Botones */
.btn-primary, .btn-info {
  border-radius: 6px;
  font-weight: 500;
}
.btn-primary:hover, .btn-info:hover {
  opacity: 0.9;
}

/* Alerta flotante */
.alerta-flotante {
  position: fixed;
  top: 20px;
  right: 20px;
  background: linear-gradient(135deg, #38bdf8, #0ea5e9);
  color: white;
  padding: 14px 20px;
  border-radius: 8px;
  font-weight: 600;
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  animation: fadeIn 0.6s ease;
  z-index: 2000;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Responsive: mantener centrado en móviles */
@media (max-width: 576px) {
  .main-container {
    height: auto;
    padding: 40px 10px;
  }
  .card {
    width: 100%;
  }
}
</style>
