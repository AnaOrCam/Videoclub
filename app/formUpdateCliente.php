<?php
use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
use Dwes\ProyectoVideoclub\Modelo\Cliente;
//include_once 'videoclub.php';
//include_once "Modelo/Cliente.php";
include_once __DIR__."/../vendor/autoload.php";
session_start();

$usuario=$_GET['usuario'];
//$vc=$_SESSION['videoclub'];
//$listaClientes=$vc->getSocios();
$DAOCliente=new DAOCliente();
$listaUsuariosDao=$DAOCliente->getAll();
$listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);
$clienteAEditar="";

foreach ($listaUsuarios as $cliente){
    if ($cliente->getUsuario()==$usuario) $clienteAEditar=$cliente;
}
//$clienteSerializado=serialize($clienteAEditar);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuevo cliente</title>
</head>
<body>

<?php
if (isset($_SESSION['errorUpdate'])) echo $_SESSION['errorUpdate']."<br>";

?>

<form action="updateCliente.php" method="post">
    <input type="hidden" name="nombreUsuario" value="<?= $usuario ?>">
    <label>Nombre y apellidos</label><input type="text" name="nombre" value="<?= $clienteAEditar->getNombre() ?>" required><br>
    <label>Nombre de usuario</label><input type="text" name="usuario" value="<?= $clienteAEditar->getUsuario() ?>" required><br>
    <label>Contraseña</label><input type="password" name="pass" required><br>
    <label>Máximo de alquileres concurrentes</label><input type="text" name="alqConc" value="<?= $clienteAEditar->getMaxAlquilerConcurrente() ?>" required><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
