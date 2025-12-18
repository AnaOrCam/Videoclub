<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOSoporte;

$soporteId=$_GET['id'] ?? 0;

$DAOSoporte=new DAOSoporte();

$soporteDao=$DAOSoporte->getSoporte($soporteId);
$tipoSoporte= $soporteDao['tipo'];

switch ($tipoSoporte){
    case "cintavideo":{
        header('Location: devolverCintavideo.php?id='.$soporteId);
        break;
    }
    case "juego":{
        header('Location: devolverJuego.php?id='.$soporteId);
        break;
    }
    case "dvd":{
        header('Location: devolverDvd.php?id='.$soporteId);
        break;
    }
}
