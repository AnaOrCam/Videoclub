<?php
use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
use Dwes\ProyectoVideoclub\Modelo\Cliente;
//include_once 'videoclub.php';
include_once __DIR__."/../vendor/autoload.php";

session_start();

//$vc=$_SESSION['videoclub'];
$DAOCliente=new DAOCliente();

$nombre=$_POST['nombre'] ?? "";
$nombreUsuario=$_POST['usuario'] ?? "";
$pass=$_POST['pass'];
$alqConcurrentes=$_POST['alqConc'] ?? 0;

$usuario=$_POST['nombreUsuario'];
$clienteAEditar="";
//$listaClientes=$vc->getSocios();

$listaUsuariosDao=$DAOCliente->getAll();
$listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);
foreach ($listaUsuarios as $cliente){
    if ($cliente->getUsuario()==$usuario) $clienteAEditar=new Cliente($cliente->getNumero(),$nombre,$nombreUsuario,password_hash($pass,PASSWORD_DEFAULT),$alqConcurrentes);
}

foreach ($listaUsuarios as $socio){
    if ($socio->getUsuario()==$nombreUsuario){
        $_SESSION['errorRegistro']="Nombre de usuario en uso.";
        header('Location: formUpdateCliente.php');
    }
}
$DAOCliente->update($clienteAEditar);
//$vc->editarClientePorAdmin($clienteAEditar,$nombre,$nombreUsuario,$pass,$alqConcurrentes);
if ($_SESSION['tipo']=='admin') header('Location:mainAdmin.php');
else header('Location:mainCliente.php');
