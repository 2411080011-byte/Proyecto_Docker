<?php
// ===============================
// CONEXIÓN
// ===============================
$db = new Database();
$pdo = $db->getConnection();

// ===============================
// OBTENER ID DEL VENDEDOR A EDITAR
// ===============================
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID no válido");
}

// Obtener datos actuales
$sql = "SELECT * FROM ventas WHERE id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$vendedorData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vendedorData) {
    die("Vendedor no encontrado");
}

// ===============================
// ACTUALIZAR VENDEDOR
// ===============================
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vendedor = trim($_POST['vendedor']);
    $direccion = trim($_POST['direccion']);
    $fecha = trim($_POST['fecha']);

    if (!empty($vendedor) && !empty($direccion) && !empty($fecha)) {
        try {
            $sqlUpdate = "UPDATE ventas 
                          SET vendedor = :vendedor, direccion = :direccion, fecha = :fecha 
                          WHERE id = :id";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([
                ':vendedor' => $vendedor,
                ':direccion' => $direccion,
                ':fecha' => $fecha,
                ':id' => $id
            ]);

            $mensaje = "Vendedor actualizado correctamente ✅";
        } catch (PDOException $e) {
            $mensaje = "Error al actualizar: " . $e->getMessage();
        }
    } else {
        $mensaje = "Complete todos los campos ⚠️";
    }
}
?>

<!-- CONTENEDOR PRINCIPAL -->
<div class="main-container">
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="background: #ffffff; max-width: 420px; width: 100%;">

    <!-- ENCABEZADO -->
    <div class="card-header py-4 px-4 text-center"
         style="background: linear-gradient(135deg, #fef3c7, #fff7ed); border-bottom: 2px solid #fbbf24;">
      <h4 class="fw-bold mb-0 text-warning">
        <i class="fa-solid fa-pen-to-square me-2 text-warning"></i> Editar Vendedor
      </h4>
      <p class="text-muted small mb-0">Modifique los datos necesarios</p>
    </div>

    <!-- FORMULARIO -->
    <div class="card-body px-4 py-3">
      <form method="POST">

        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-solid fa-user-tie me-1 text-info"></i> Nombre del Vendedor
          </label>
          <input type="text" name="vendedor" value="<?= htmlspecialchars($vendedorData['vendedor']) ?>"
                 class="form-control rounded-3 shadow-sm" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-solid fa-map-location-dot me-1 text-danger"></i> Dirección
          </label>
          <input type="text" name="direccion" value="<?= htmlspecialchars($vendedorData['direccion']) ?>"
                 class="form-control rounded-3 shadow-sm" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="fa-regular fa-calendar-days me-1 text-primary"></i> Fecha
          </label>
          <input type="date" name="fecha"
                 value="<?= htmlspecialchars($vendedorData['fecha']) ?>"
                 class="form-control rounded-3 shadow-sm" required>
        </div>

        <!-- BOTONES -->
        <div class="d-flex justify-content-between mt-4">
          <button type="submit" class="btn btn-warning shadow-sm text-white fw-semibold">
            <i class="fa-solid fa-rotate me-1"></i> Actualizar
          </button>
          
          <a href="/modules/vendedores/index_lista_vendedores.php" class="btn btn-secondary shadow-sm text-white">
            <i class="fa-solid fa-list me-1"></i> Lista de Vendedores
          </a>
        </div>

      </form>
    </div>
  </div>
</div>

<?php if (!empty($mensaje)): ?>
  <div class="alerta-flotante"><?= htmlspecialchars($mensaje) ?></div>

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
  margin: 0;
}

/* Contenedor centrado */
.main-container {
  font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 86vh;
  padding: 20px;
}

/* Estilo tarjeta */
.card {
  border-radius: 1rem !important;
  transition: 0.3s ease-in-out;
}
.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.form-control:focus {
  border-color: #fbbf24 !important;
  box-shadow: 0 0 0 0.25rem rgba(251,191,36,0.25) !important;
}

.btn-warning {
  background-color: #f59e0b;
}
.btn-warning:hover {
  opacity: 0.9;
}

.btn-secondary {
  background-color: #94a3b8;
  color: white;
}
.btn-secondary:hover {
  opacity: 0.9;
}

/* Alerta flotante */
.alerta-flotante {
  position: fixed;
  top: 20px;
  right: 20px;
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
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
