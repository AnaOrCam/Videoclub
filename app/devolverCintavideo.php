<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
use Dwes\ProyectoVideoclub\Modelo\CintaVideo;

$soporteId=$_GET['id'] ?? 0;

$DAOCintavideo=new DAOCintaVideo();
$cintaOriginal=$DAOCintavideo->getCintavideo($soporteId);

$auxCintavideo=new CintaVideo($cintaOriginal['id'],$cintaOriginal['nombre'],$cintaOriginal['precio'],$cintaOriginal['duracion']);

$DAOCintavideo->update($auxCintavideo);
header('Location: mainAdmin.php');