<?php

include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOSoporte;
session_start();

$soporteId=$_GET['id'];
$DAOSoporte=new DAOSoporte();

$soporteDao=$DAOSoporte->getSoporte($soporteId);
$tipoSoporte= $soporteDao['tipo'];

switch ($tipoSoporte){
    case "cintavideo":{
        header('Location: formUpdateCintavideo.php?id='.$soporteDao['id']);
        break;
    }
    case "juego":{
        header('Location: formUpdateJuego.php?id='.$soporteDao['id']);
        break;
    }
    case "dvd":{
        header('Location: formUpdateDvd.php?id='.$soporteDao['id']);
        break;
    }
}