<?php

session_start();
$usuarioABorrar=$_GET['usuario'] ?? "";
$listaClientes=$_SESSION['listaUsuarios'] ?? "";

if (array_key_exists($usuarioABorrar, $listaClientes)) {
    unset($listaClientes[$usuarioABorrar]);
}

$_SESSION['listaUsuarios']=$listaClientes;
header('Location: mainAdmin.php');
?>

