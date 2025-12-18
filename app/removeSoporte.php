<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOSoporte;
session_start();
$soporteABorrar=$_GET['id'] ?? "";
$DAOSoporte=new DAOSoporte();
$DAOSoporte->delete($soporteABorrar);

//$listaClientes=$_SESSION['listaUsuarios'] ?? "";

//if (array_key_exists($usuarioABorrar, $listaClientes)) {
//    unset($listaClientes[$usuarioABorrar]);
//}

//$_SESSION['listaUsuarios']=$listaClientes;

header('Location: mainAdmin.php');
?>
