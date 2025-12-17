<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\Modelo\Cliente;
use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
session_start();
$usuarioABorrar=$_GET['id'] ?? "";
$DAOCliente=new DAOCliente();
$DAOCliente->delete($usuarioABorrar);

//$listaClientes=$_SESSION['listaUsuarios'] ?? "";

//if (array_key_exists($usuarioABorrar, $listaClientes)) {
//    unset($listaClientes[$usuarioABorrar]);
//}

//$_SESSION['listaUsuarios']=$listaClientes;

header('Location: mainAdmin.php');
?>

