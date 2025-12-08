<?php

//include_once "Videoclub.php";
include_once __DIR__."/../vendor/autoload.php";

session_start();

$nombreUsuario=$_POST['usuario'] ?? $_GET['usuario'] ?? "";
$nombre=$_POST['nombre'] ?? $_GET['nombre'] ?? "";
$pass=$_POST['pass'] ?? $_GET['pass'] ?? "";
$alqConcurrentes=$_POST['alqConc'] ?? $_GET['alqConc'] ?? 0;
$validado=$_GET['validado'] ?? "";

$listaUsuariosYPass=$_SESSION['listaUsuarios'];
$vc=$_SESSION['videoclub'] ?? [];
$listaSocios=$vc->getSocios();

foreach ($listaSocios as $socio){
    if ($socio->getUsuario()==$nombreUsuario){
        $_SESSION['errorRegistro']="Nombre de usuario en uso.";
        header('Location: formCreateCliente.php');
    }
}
$resend=Resend::client('re_QYXkMkfB_MT4QAVycvY5VocdA6CMRAdgt');

$resend->emails->send([
    'from'=> 'onboarding@resend.dev',
    'to'=> 'ana.oc.094@gmail.com',
    'subject'=> 'Nuevo cliente',
    'html'=> "<p>http://localhost:80/videoclub/app/createCliente.php?validado=1&&usuario=$nombreUsuario&&nombre=$nombre&&pass=$pass&&alqConc=$alqConcurrentes</p>"
]);

echo "Se ha enviado un mensaje de validacion al correo.";
if ($validado==1){
    $vc->incluirSocio($nombre, $nombreUsuario,$pass,$alqConcurrentes);
    $listaUsuariosYPass[$nombreUsuario]=$pass;
    $_SESSION['listaUsuarios']=$listaUsuariosYPass;
    unset($_SESSION['errorRegistro']);
    header('Location: mainAdmin.php');
}




