<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\Modelo\Dvd;

$soporteId=$_GET['id'] ?? 0;

$DAODvd=new DAODvd();
$dvd=$DAODvd->getJuego($soporteId);

$auxDvd=new Juego($dvd['id'],$dvd['titulo'],$dvd['precio'],$dvd['consola'],$dvd['minNumJug'],$dvd['maxNumJug']);

$DAODvd->update($auxDvd);
header('Location: mainAdmin.php');