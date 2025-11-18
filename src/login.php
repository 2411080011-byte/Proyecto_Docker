<?php
session_start();

// ===== CONFIGURACIÓN DE GOOGLE =====
include 'config_oauth.php';

$scope = 'email profile openid';
$response_type = 'code';
$access_type = 'offline';

$google_auth_url = 'https://accounts.google.com/o/oauth2/v2/auth' .
    '?client_id=' . $google_client_id .
    '&redirect_uri=' . urlencode($redirect_uri) .
    '&response_type=' . $response_type .
    '&scope=' . urlencode($scope) .
    '&access_type=' . $access_type;

// Mostrar error si viene desde verificar_login.php
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistema</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

  <style>
    .fondo-login {
      width: 100%;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      object-fit: cover;
      z-index: -1;
    }

    .login-card-body {
      background: rgba(255, 255, 255, 0.36);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      padding: 2rem;
      color: #000;
    }

    .login-box .card {
      background: transparent;
    }

    .input-group-append{
      background-color: #fff;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <img class="fondo-login" src="/assets/img/fondo.avif">

  <div class="login-box">
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo">
          <b>Inicia sesión</b>
        </div>

        <?php if ($error): ?>
          <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="includes/verificar_login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Usuario" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
          </div>
        </form>

        <div class="text-center mt-3">
          <p>O inicia con:</p>
          <a href="<?= $google_auth_url ?>" class="btn btn-danger btn-block">
            <i class="fab fa-google"></i> Iniciar con Google
          </a>
        </div>

        <p class="mb-1 mt-3 text-center">
          <small>Todos los derechos reservados: <strong>Ing Jesús Arotinco</strong></small>
        </p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
