<?php
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
use Dwes\ProyectoVideoclub\Modelo\CintaVideo;
include_once __DIR__."/../vendor/autoload.php";

session_start();

$id=$_POST['id'] ?? 0;
$nombre=$_POST['nombre'] ?? "";
$precio=$_POST['precio'] ?? 0;
$duracion=$_POST['duracion'] ?? 0;

$DAOCintavideo=new DAOCintaVideo();
$cintavideo=new CintaVideo($id,$nombre,$precio,$duracion);
$DAOCintavideo->insert($cintavideo);

header('Location: mainAdmin.php');

