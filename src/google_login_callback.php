<?php
session_start();

include 'config_oauth.php';

if (isset($_GET['code'])) {
    $token_url = 'https://oauth2.googleapis.com/token';

    $data = [
        'code' => $_GET['code'],
        'client_id' => $google_client_id,
        'client_secret' => $google_client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($token_url, false, $context);
    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $userinfo = file_get_contents('https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . $token_data['access_token']);
        $user = json_decode($userinfo, true);

        // Crear sesión
        $_SESSION['usuario_id'] = $user['sub'];
        $_SESSION['usuario_nombre'] = $user['name'];
        $_SESSION['usuario_email'] = $user['email'];

        header('Location: admin/index.php');
        exit();
    } else {
        echo "Error al obtener el token de Google.";
    }
} else {
    echo "No se recibió el código de autenticación.";
}
?>
