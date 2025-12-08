<?php

//include_once "Videoclub.php";
include_once __DIR__."/../vendor/autoload.php";
session_start();
$videoclub=$_SESSION['videoclub'] ?? [];
echo '<h1>Bienvenido '.$_SESSION['usuario'].'</h1><br><br>';

$listaUsuarios=$videoclub->getSocios();
$numUsuario="";
$nombreUsuario="";
foreach ($listaUsuarios as $usuario){
    if ($usuario->getUsuario()==$_SESSION['usuario']){
        $numUsuario=$usuario->getNumero();
        $nombreUsuario=$usuario->getUsuario();
    }
}
$listaAlquileres=$videoclub->getAlquileresPorCliente($numUsuario);

echo "<br><em>Lista de soportes alquilados: </em><br>";
echo "<ul>";
foreach ($listaAlquileres as $alquiler){
    echo "<li>".$alquiler->muestraResumen()."</li>";
}
echo "</ul>";

echo "<br><br><br><a href='formUpdateCliente.php?usuario=$nombreUsuario'>Editar datos</a>";
echo "<br><br><br><a href='Logout.php'>Cerrar Sesión</a>";