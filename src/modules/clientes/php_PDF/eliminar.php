<?php
include_once 'Cliente.php';
include '../../../includes/config.php';

$database = new Database();

$db = $database->getConnection();

$cliente = new Cliente($db);


$cliente->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado');


if($cliente->leerUno()){

    if($cliente->eliminar()){

        header("Location: ../index_lista_clientes.php?message=Cliente eliminado exitosamente");

        exit();

    } else{

        die('No se pudo eliminar el cliente.');

    }

} else {

    die('Cliente no encontrado.');

}

?>