<?php
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
use Dwes\ProyectoVideoclub\Modelo\Juego;
include_once __DIR__."/../vendor/autoload.php";

$id=$_POST['id'] ?? 0;
$nombre=$_POST['nombre'] ?? "";
$precio=$_POST['precio'] ?? 0;
$consola=$_POST['consola'] ?? "";
$minJug=$_POST['minJug'] ?? 0;
$maxJug=$_POST['maxJug'] ?? 0;
$cliente=$_POST['idCliente'] ?? 0;

$DAOJuego=new DAOJuego();
$juego=new Juego($id,$nombre,$precio,$consola,$minJug,$maxJug);
if ($cliente==null) $DAOJuego->update($juego);
else $DAOJuego->update($juego,$cliente);

header('Location: mainAdmin.php');