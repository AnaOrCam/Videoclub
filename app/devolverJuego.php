<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
use Dwes\ProyectoVideoclub\Modelo\Juego;

$soporteId=$_GET['id'] ?? 0;

$DAOJuego=new DAOJuego();
$juego=$DAOJuego->getJuego($soporteId);

$auxJuego=new Juego($juego['id'],$juego['titulo'],$juego['precio'],$juego['consola'],$juego['minNumJug'],$juego['maxNumJug']);

$DAOJuego->update($auxJuego);
header('Location: mainAdmin.php');