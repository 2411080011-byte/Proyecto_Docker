<?php
session_start();
require_once 'config.php';

$database = new Database();
$db = $database->getConnection();

// Obtener datos del formulario
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = "Por favor, completa todos los campos.";
    header("Location: ../login.php");
    exit;
}

try {
    // Buscar usuario por nombre (sin el campo 'rol')
    $query = "SELECT id, username, password FROM users WHERE username = :username LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar contraseña encriptada
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['username'];

            header("Location: ../admin/index.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['login_error'] = "Usuario no encontrado.";
    }

} catch (PDOException $e) {
    $_SESSION['login_error'] = "Error en la base de datos: " . $e->getMessage();
}

header("Location: ../login.php");
exit;
?>
