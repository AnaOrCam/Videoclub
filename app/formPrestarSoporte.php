<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
use Dwes\ProyectoVideoclub\Modelo\Cliente;

$idSoporte=$_GET['id'];

$DAOCliente=new DAOCliente();

$videoclub = $_SESSION['videoclub'] ?? [];
//    $listaUsuarios = $_SESSION['listaUsuarios'];
$listaUsuariosDao=$DAOCliente->getAll();
$listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);

echo "<br><em>Lista de Clientes:</em><br>";
echo "<ul>";
foreach ($listaUsuarios as $cliente) {
    echo '<li>'.$cliente->__toString().'</li><br>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prestar soporte</title>
</head>
<body>

<form action="prestarSoporte.php" method="post">
    <input type="hidden" name="idSoporte" value="<?= $idSoporte ?>">
    <label>ID del cliente</label><input type="text" name="id" required><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
