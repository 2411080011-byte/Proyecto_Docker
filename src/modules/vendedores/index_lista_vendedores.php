<?php
// admin/index.php
session_start();
$page_title = "Dashboard Vendedores";

require_once __DIR__ . '/../../includes/config.php';
require __DIR__ . '/../../admin/header.php';
require __DIR__ . '/../../admin/navbar.php';
require __DIR__ . '/../../admin/sidebar.php';
?>

<article class="main-header">
    <?php
    include 'boostrap/tabla_vendedores.php';
    ?>
</article>

<?php
    require __DIR__ . '/../../admin/footer.php'
?>