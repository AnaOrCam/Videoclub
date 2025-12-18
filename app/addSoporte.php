<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOSoporte;
session_start();

$soporteTipo=$_POST['soporte'] ?? "";
$id=0;

$DAOSoporte=new DAOSoporte();

if (!empty($soporteTipo) && $soporteTipo!='none'){
    $DAOSoporte->insert($soporteTipo);
    $listaSoportesDao=$DAOSoporte->getAll();
    foreach ($listaSoportesDao as $soporte){
        if ($id<$soporte['id'] && $soporte['id']!=null) $id=$soporte['id'];
    }

    switch ($soporteTipo){
        case 'juego': {
            header('Location: addJuegoForm.php?id='.$id);
            break;
        }
        case 'dvd':{
            header('Location: addDvdForm.php?id='.$id);
            break;
        }
        case 'cintavideo':{
            header('Location: addCintavideoForm.php?id='.$id);
        }
    }
    unset($_SESSION['errorRegistro']);

}else{
    $_SESSION['errorRegistro']='Tienes que seleccionar un soporte';
    header('Location: addSoporteForm.php');
}
