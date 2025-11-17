<?php
// admin/index.php
session_start();
$page_title = "Dashboard Principal";

include 'header.php';
include 'navbar.php';
include 'sidebar.php';

// ============================
// Conexión a la base de datos
// ============================
$db = new Database();
$pdo = $db->getConnection();

// ============================
// Obtener datos de los cards
// ============================

// Total de vendedores (contar registros en ventas)
$stmtVendedores = $pdo->query("SELECT COUNT(*) as total_vendedores FROM ventas");
$totalVendedores = $stmtVendedores->fetch(PDO::FETCH_ASSOC)['total_vendedores'];

// Total de clientes (tabla clientes)
$stmtClientes = $pdo->query("SELECT COUNT(*) as total_clientes FROM clientes");
$totalClientes = $stmtClientes->fetch(PDO::FETCH_ASSOC)['total_clientes'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Dashboard</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Total Vendedores -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalVendedores ?></h3>
                            <p>Total Vendedores</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="/modules/vendedores/index_lista_vendedores.php " class="small-box-footer">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Clientes -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalClientes ?></h3>
                            <p>Total Clientes</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-friends"></i></div>
                        <a href="/modules/clientes/index_lista_clientes.php" class="small-box-footer">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Vendedores Activos (dejamos estático o tu código anterior) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>--</h3>
                            <p>Vendedores Activos</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-check"></i></div>
                        <a href="#" class="small-box-footer">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Ventas Pendientes (dejamos estático o tu código anterior) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>--</h3>
                            <p>Ventas Pendientes</p>
                        </div>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                        <a href="#" class="small-box-footer">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main row (charts, calendar, etc.) -->
            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <!-- Gráfico de Ventas por Vendedor -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i> Ventas por Vendedor
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="ventasChart" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </section>

                <section class="col-lg-5 connectedSortable">
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i> Calendario
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

<script>
var ctx = document.getElementById('ventasChart').getContext('2d');
var ventasChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Juan Pérez', 'María García', 'Carlos López', 'Ana Martínez', 'Pedro Sánchez'],
        datasets: [{
            label: 'Ventas del Mes',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>
