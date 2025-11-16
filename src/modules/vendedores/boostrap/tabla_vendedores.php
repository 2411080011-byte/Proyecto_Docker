<?php
// Crear instancia de conexión
$db = new Database();
$pdo = $db->getConnection();

// ===============================
// ELIMINAR VENDEDOR
// ===============================
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    try {
        $stmt = $pdo->prepare("DELETE FROM ventas WHERE id = ?");
        $stmt->execute([$delete_id]);
        echo "<script>
                alert('Vendedor eliminado correctamente.');
                window.location.href = '".$_SERVER['PHP_SELF']."';
              </script>";
        exit;
    } catch (PDOException $e) {
        die("Error al eliminar: " . $e->getMessage());
    }
}

// ===============================
// CONSULTAR DATOS DE LA TABLA VENDEDORES
// ===============================
try {
    $query = "SELECT id, vendedor, direccion, fecha FROM ventas ORDER BY id DESC";
    $stmt = $pdo->query($query);
    $vendedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar: " . $e->getMessage());
}
?>

<section class="content mt-4">
  <div class="container-fluid">

    <!-- CARD PRINCIPAL -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="background: #ffffff;">
      
      <!-- ENCABEZADO -->
      <div class="card-header py-4 px-4 d-flex justify-content-between align-items-center"
           style="background: linear-gradient(135deg, #dbeafe, #eff6ff); border-bottom: 2px solid #38bdf8;">
        <div>
          <h4 class="fw-bold mb-0 text-primary">
            <i class="fa-solid fa-users me-2 text-info"></i> Lista de Vendedores
          </h4>
          <p class="text-muted small mb-0">Resumen general de los vendedores registrados</p>
        </div>
        <div class="text-end">
          <span class="badge bg-gradient text-white shadow-sm px-3 py-2" 
                style="background: linear-gradient(135deg, #38bdf8, #0ea5e9);">
            <i class="fa-solid fa-database me-1"></i> <?= count($vendedores) ?> registrados
          </span>
        </div>
      </div>

      <!-- CUERPO -->
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" id="tablaVendedores">
            <thead style="background-color: #f0f9ff;" class="text-uppercase text-secondary small">
              <tr>
                <th><i class="fa-solid fa-id-badge text-info me-1"></i> ID</th>
                <th><i class="fa-solid fa-user-tie text-info me-1"></i> Vendedor</th>
                <th><i class="fa-solid fa-map-location-dot text-info me-1"></i> Dirección</th>
                <th><i class="fa-solid fa-calendar-day text-info me-1"></i> Fecha</th>
                <th><i class="fa-solid fa-gear text-info me-1"></i> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($vendedores)): ?>
                <?php foreach ($vendedores as $vendedor): ?>
                  <tr class="fila-vendedor">
                    <td>
                      <span class="badge bg-gradient text-white shadow-sm" 
                            style="background: linear-gradient(135deg, #38bdf8, #0ea5e9);">
                        <?= htmlspecialchars($vendedor['id']) ?>
                      </span>
                    </td>
                    <td class="fw-semibold text-dark">
                      <i class="fa-solid fa-user text-primary me-1"></i>
                      <?= htmlspecialchars($vendedor['vendedor']) ?>
                    </td>
                    <td>
                      <i class="fa-solid fa-location-dot text-danger me-1"></i>
                      <?= htmlspecialchars($vendedor['direccion']) ?>
                    </td>
                    <td>
                      <i class="fa-regular fa-clock text-muted me-1"></i>
                      <?= htmlspecialchars(date('d/m/Y', strtotime($vendedor['fecha']))) ?>
                    </td>
                    <td>
                      <a href="detalle_vendedor.php?id=<?= $vendedor['id'] ?>" 
                         class="btn btn-sm btn-primary mb-1 shadow-sm">
                        <i class="fa-solid fa-eye me-1"></i> Ver
                      </a>
                      <a href="?delete_id=<?= $vendedor['id'] ?>" 
                         class="btn btn-sm btn-danger mb-1 shadow-sm" 
                         onclick="return confirm('¿Estás seguro de eliminar este vendedor?');">
                        <i class="fa-solid fa-trash me-1"></i> Eliminar
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center text-muted py-5">
                    <i class="fa-regular fa-folder-open fa-2x text-secondary mb-2"></i><br>
                    No hay vendedores registrados actualmente
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
body {
  background-color: #f4f6f9 !important;
  font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
}
.card {
  border-radius: 1rem !important;
  transition: 0.3s ease-in-out;
}
.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.table thead th {
  font-weight: 600;
  letter-spacing: 0.6px;
  border-bottom: 2px solid #e5e7eb !important;
}
.table-hover tbody tr:hover {
  background-color: #e0f2fe !important;
  transition: 0.3s ease;
}
.badge {
  font-size: 0.9rem;
}
.fila-vendedor td {
  vertical-align: middle;
}
.btn-primary, .btn-danger {
  border-radius: 6px;
  font-weight: 500;
}
.btn-primary:hover, .btn-danger:hover {
  opacity: 0.9;
}
</style>
