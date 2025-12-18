<?php

include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
use Dwes\ProyectoVideoclub\Modelo\Juego;

$idSoporte=$_GET['idSoporte'];
$idCliente=$_GET['idCliente'];

$DAOJuego=new DAOJuego();

$juegoOriginal=$DAOJuego->getJuego($idSoporte);
$juego=new Juego($juegoOriginal['id'],$juegoOriginal['titulo'],$juegoOriginal['precio'],$juegoOriginal['consola'],$juegoOriginal['minNumJug'],$juegoOriginal['maxNumJug']);

$DAOJuego->update($juego,$idCliente);
header('Location: mainAdmin.php');
