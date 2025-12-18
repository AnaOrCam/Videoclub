<?php

include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
use Dwes\ProyectoVideoclub\Modelo\CintaVideo;

$idSoporte=$_GET['idSoporte'];
$idCliente=$_GET['idCliente'];

$DAOCintaVideo=new DAOCintaVideo();

$cintaOriginal=$DAOCintaVideo->getCintavideo($idSoporte);
$cinta=new CintaVideo($cintaOriginal['id'],$cintaOriginal['nombre'],$cintaOriginal['precio'],$cintaOriginal['duracion']);

$DAOCintaVideo->update($cinta,$idCliente);
header('Location: mainAdmin.php');