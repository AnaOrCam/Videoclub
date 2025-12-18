<?php
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\Modelo\Dvd;
include_once __DIR__."/../vendor/autoload.php";

$id=$_POST['id'] ?? 0;
$nombre=$_POST['nombre'] ?? "";
$precio=$_POST['precio'] ?? 0;
$format=$_POST['formato'] ?? "";
$idiomas=$_POST['idiomas'] ?? "";
$cliente=$_POST['idCliente'] ?? 0;

$DAODvd=new DAODvd();
$dvd=new Dvd($id,$nombre,$precio,$format,$idiomas);
if ($cliente==null) $DAODvd->update($dvd);
else $DAODvd->update($dvd,$cliente);

header('Location: mainAdmin.php');
