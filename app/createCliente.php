<?php

include_once "Videoclub.php";

session_start();

$nombreUsuario=$_POST['usuario'] ?? "";
$nombre=$_POST['nombre'] ?? "";
$pass=$_POST['pass'];
$alqConcurrentes=$_POST['alqConc'] ?? 0;

$listaUsuariosYPass=$_SESSION['listaUsuarios'];
$vc=$_SESSION['videoclub'] ?? [];
$listaSocios=$vc->getSocios();

foreach ($listaSocios as $socio){
    if ($socio->getUsuario()==$nombreUsuario){
        $_SESSION['errorRegistro']="Nombre de usuario en uso.";
        header('Location: formCreateCliente.php');
    }
}

$vc->incluirSocio($nombre, $nombreUsuario,$pass,$alqConcurrentes);
$listaUsuariosYPass[$nombreUsuario]=$pass;
$_SESSION['listaUsuarios']=$listaUsuariosYPass;
unset($_SESSION['errorRegistro']);
header('Location: mainAdmin.php');


