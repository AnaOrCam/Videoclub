<?php

include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\Modelo\Dvd;

$idSoporte=$_GET['idSoporte'];
$idCliente=$_GET['idCliente'];

$DAODvd=new DAODvd();

$dvdOriginal=$DAODvd->getDvd($idSoporte);
$dvd=new Dvd($dvdOriginal['id'],$dvdOriginal['titulo'],$dvdOriginal['precio'],$dvdOriginal['formato'],$dvdOriginal['idiomas']);

$DAODvd->update($dvd,$idCliente);
header('Location: mainAdmin.php');
