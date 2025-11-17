<?php

include_once 'Cliente.php';

$database = new Database();
$db = $database->getConnection();
$cliente = new Cliente($db);

$stmt = $cliente->leer();
$num = $stmt->rowCount();
$total_clientes = $cliente->contar();
?>

<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.2/dist/css/adminlte.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* CONTENEDORES DE LOS BOTONES Y TABLA */
    .row, .card{
        margin: 0 20px;
    }


/* ======= HEADER ======= */
.header-crud {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 0;
    margin-bottom: 30px;
}

/* ======= BOTONES ======= */
.btn-pdf {
    background-color: #dc3545;
    color: white;
    border: none;
    margin-left: 10px;
}
.btn-pdf:hover {
    background-color: #c82333;
    color: white;
}

/* Mantener separaciones idénticas */
.table-actions .btn {
    margin: 2px;
    padding: 6px 10px;
}

/* Tabla responsive con AdminLTE */
.table-responsive {
    border-radius: 0.5rem;
    overflow-x: auto;
}

/* Mantener la tarjeta de AdminLTE */
.card {
    border-radius: 0.8rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* ======= RESPONSIVE ======= */
@media (max-width: 768px) {
    .header-crud h1 {
        font-size: 1.6rem;
    }

    .header-crud p {
        font-size: 0.95rem;
    }

    .row.mb-4 {
        text-align: center;
    }

    .row.mb-4 .col-md-6 {
        margin-bottom: 0.75rem;
    }

    .row.mb-4 .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .badge {
        font-size: 1rem !important;
    }

    .table {
        font-size: 0.9rem;
    }

    .table-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .btn-pdf {
        margin-left: 0;
    }
    .table-actions .btn {
        width: 100%;
        margin: 3px 0;
    }
    
}
</style>

<!-- ======= ENCABEZADO ======= -->
<div class="header-crud">
    <div class="container">
        <h1 class="text-center"><i class="fas fa-users me-2"></i> Gestión de Clientes</h1>
        <p class="text-center mb-0">Sistema CRUD completo con generación de PDF</p>
    </div>
</div>

<!-- ======= CONTENIDO PRINCIPAL ======= -->
<div class="container mb-5">
    <!-- Botones -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6 d-flex flex-wrap justify-content-center justify-content-md-start">
            <a href="index_agregar_cliente.php" class="btn btn-primary me-2 mb-2 mb-md-0">
                <i class="fas fa-plus-circle me-1"></i> Nuevo Cliente
            </a>
            <a href="php_PDF/generar_pdf.php" class="btn btn-pdf" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Generar PDF
            </a>
        </div>
        <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
            <span class="badge bg-secondary fs-6 p-2">
                <i class="fas fa-chart-bar me-1"></i> Total: <?php echo $total_clientes; ?> clientes
            </span>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0 text-center text-md-start">
                <i class="fas fa-list me-2 text-primary"></i> Lista de Clientes
            </h5>
        </div>
        <div class="card-body">
            <?php if ($num > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                                    <td class="table-actions text-center">
                                        <a href="/modules/clientes/php_PDF/generar_pdf_individual.php?id=<?php echo $row['id']; ?>"
                                           class="btn btn-warning btn-sm" target="_blank" title="Generar PDF">
                                           <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a href="index_editar_cliente.php?id=<?php echo $row['id']; ?>"
                                           class="btn btn-primary btn-sm" title="Editar">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/modules/clientes/php_PDF/eliminar.php?id=<?php echo $row['id']; ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Estás seguro de eliminar este cliente?')"
                                           title="Eliminar">
                                           <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>No hay clientes registrados.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.2/dist/js/adminlte.min.js"></script>
