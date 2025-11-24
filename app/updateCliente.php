<?php

include_once 'videoclub.php';

session_start();

$vc=$_SESSION['videoclub'];
$nombre=$_POST['nombre'] ?? "";
$nombreUsuario=$_POST['usuario'] ?? "";
$pass=$_POST['pass'];
$alqConcurrentes=$_POST['alqConc'] ?? 0;
$usuario=$_POST['nombreUsuario'];
$clienteAEditar="";
$listaClientes=$vc->getSocios();
foreach ($listaClientes as $cliente){
    if ($cliente->getUsuario()==$usuario) $clienteAEditar=$cliente;
}

$listaSocios=$vc->getSocios();
foreach ($listaSocios as $socio){
    if ($socio->getUsuario()==$nombreUsuario){
        $_SESSION['errorRegistro']="Nombre de usuario en uso.";
        header('Location: formUpdateCliente.php');
    }
}
$vc->editarClientePorAdmin($clienteAEditar,$nombre,$nombreUsuario,$pass,$alqConcurrentes);
if ($_SESSION['tipo']=='admin') header('Location:mainAdmin.php');
else header('Location:mainCliente.php');
