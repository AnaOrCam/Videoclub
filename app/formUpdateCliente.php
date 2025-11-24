<?php

include_once 'videoclub.php';
include_once "modelo/Cliente.php";
session_start();

$usuario=$_GET['usuario'];
$vc=$_SESSION['videoclub'];
$listaClientes=$vc->getSocios();
$clienteAEditar="";

foreach ($listaClientes as $cliente){
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
