<?php

//include_once "Videoclub.php";
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
use \Dwes\ProyectoVideoclub\Modelo\CintaVideo;
use \Dwes\ProyectoVideoclub\Modelo\Juego;
use \Dwes\ProyectoVideoclub\Modelo\Dvd;
session_start();

$DAOCliente=new DAOCliente();
$DAOCintavideo=new DAOCintaVideo();
$DAOJuego=new DAOJuego();
$DAODvd=new DAODvd();

$listaUsuariosDao=$DAOCliente->getAll();
$listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);

$listaCintavideoDao=$DAOCintavideo->getAll();
$listaCintavideo=array_map(fn($cinta)=>new CintaVideo($cinta['id'],$cinta['nombre'],$cinta['precio'],$cinta['duracion']),$listaCintavideoDao);

$listaDvdDao=$DAODvd->getAll();
$listaDvd=array_map(fn($dvd)=>new Dvd($dvd['id'],$dvd['titulo'],$dvd['precio'],$dvd['idiomas'],$dvd['formato']),$listaDvdDao);

$listaJuegoDao=$DAOJuego->getAll();
$listaJuego=array_map(fn($juego)=>new Juego($juego['id'],$juego['titulo'],$juego['precio'],$juego['consola'],$juego['minNumJug'],$juego['maxNumJug']),$listaJuegoDao);

$listaSoportesDao=[];
$listaSoportesDao=[...$listaCintavideoDao,...$listaDvdDao,...$listaJuegoDao];
$listaSoportes=[];
$listaSoportes=[...$listaJuego,...$listaCintavideo,...$listaDvd];

//$videoclub=$_SESSION['videoclub'] ?? [];
echo '<h1>Bienvenido '.$_SESSION['usuario'].'</h1><br><br>';

//$listaUsuarios=$videoclub->getSocios();
$numUsuario="";
$nombreUsuario="";
foreach ($listaUsuarios as $usuario){
    if ($usuario->getUsuario()==$_SESSION['usuario']){
        $numUsuario=$usuario->getNumero();
        $nombreUsuario=$usuario->getUsuario();
    }
}
//$listaAlquileres=$videoclub->getAlquileresPorCliente($numUsuario);

echo "<br><em>Lista de soportes alquilados: </em><br>";
echo "<ul>";
//foreach ($listaAlquileres as $alquiler){
//    echo "<li>".$alquiler->muestraResumen()."</li>";
//}
for ($i = 0; $i < count($listaSoportes); $i++) {
    if ($listaSoportesDao[$i]['idCliente']==$numUsuario) $listaSoportes[$i]->muestraResumen();
}
echo "</ul>";

echo "<br><br><br><a href='formUpdateCliente.php?usuario=$nombreUsuario'>Editar datos</a>";
echo "<br><br><br><a href='Logout.php'>Cerrar Sesión</a>";