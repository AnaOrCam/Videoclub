<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOSoporte;

$soporteId=$_POST['idSoporte'] ?? "";
$clienteId=$_POST['id']?? "";

$DAOSoporte=new DAOSoporte();

$soporteDao=$DAOSoporte->getSoporte($soporteId);
$tipoSoporte= $soporteDao['tipo'];

switch ($tipoSoporte){
    case "cintavideo":{
        header('Location: prestarCintavideo.php?idSoporte='.$soporteId.'&idCliente='.$clienteId);
        break;
    }
    case "juego":{
        header('Location: prestarJuego.php?idSoporte='.$soporteId.'&idCliente='.$clienteId);
        break;
    }
    case "dvd":{
        header('Location: prestarDvd.php?idSoporte='.$soporteId.'&idCliente='.$clienteId);
        break;
    }
}
