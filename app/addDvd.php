<?php
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\Modelo\Dvd;
include_once __DIR__."/../vendor/autoload.php";

session_start();

$id=$_POST['id'] ?? 0;
$nombre=$_POST['nombre'] ?? "";
$precio=$_POST['precio'] ?? 0;
$formato=$_POST['formato'] ?? "";
$idiomas=$_POST['idiomas'] ?? "";

$DAODvd=new DAODvd();
$dvd=new Dvd($id,$nombre,$precio,$idiomas,$formato);
var_dump($dvd);
$DAODvd->insert($dvd);

header('Location: mainAdmin.php');
