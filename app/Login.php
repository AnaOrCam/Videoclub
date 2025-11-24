<?php

include_once "Videoclub.php";
include_once "modelo/Cliente.php";
include_once "modelo/Soporte.php";
include_once "modelo/CintaVideo.php";
include_once "modelo/Dvd.php";
include_once "modelo/Juego.php";

session_start();
use Dwes\ProyectoVideoclub\Videoclub as vc;
$vc = new vc("Severo 8A");

//voy a incluir unos cuantos soportes de prueba
$soporte1=$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$soporte2=$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$soporte3=$vc->incluirDvd("Torrente", 4.5, "es","16:9");
$soporte4=$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$soporte5=$vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
$soporte6=$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$soporte7=$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

$cliente1=$vc->incluirSocio("Amancio Ortega","aortega","aortega");
$cliente2=$vc->incluirSocio("Pablo Picasso", "ppicasso","ppicasso",2);
$vc->alquilarSocioProductos(0,[0,1,6]);
$vc->alquilarSocioProductos(1,[2,4]);
$arrayClientes=[$cliente1,$cliente2];
$arraySoportes=[$soporte1,$soporte2,$soporte3,$soporte4,$soporte5,$soporte6,$soporte7];
$alquileresVigentes=[
    $cliente1->getNumero() => [$soporte1,$soporte2,$soporte7],
    $cliente2->getNumero() => [$soporte3,$soporte5]
];
$_SESSION['videoclub']=$vc;
$usuarios=[
    'admin'=>'admin'
];
foreach ($arrayClientes as $cliente){
    $usuario=$cliente->usuario;
    $pass=$cliente->pass;
    $usuarios[$usuario]=$pass;
    echo "<br>";
}echo"<br>";

$_SESSION['listaUsuarios']=$usuarios;

$usuarioLogueado=$_POST['usuario'] ?? "";
$pass= $_POST['pass'] ?? "";


if (isset($usuarios[$usuarioLogueado]) && $usuarios[$usuarioLogueado]==$pass){
    $_SESSION['usuario']=$usuarioLogueado;
    unset($_SESSION['accesoIncorrecto']);
    if ($usuarioLogueado=='admin'){
        $_SESSION['tipo']='admin';
        header('Location: mainAdmin.php');
    }
    else{
        $_SESSION['tipo']='cliente';
        header('Location: mainCliente.php');
    }
}else{
    $_SESSION['accesoIncorrecto']=true;
    header('Location: Index.php');
}
