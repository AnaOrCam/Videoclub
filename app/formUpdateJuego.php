<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
$id=$_GET['id'] ?? 0;
$DAOJuego=new DAOJuego();

$juego=$DAOJuego->getJuego($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Cinta Video</title>
</head>
<body>

<?php
$titulo=$juego['titulo'];
$precio=$juego['precio'];
$consola=$juego['consola'];
$minJug=$juego['minNumJug'];
$maxJug=$juego['maxNumJug'];
$idCliente=$juego['idCliente'];

?>

<form action="updateJuego.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nombre</label><input type="text" name="nombre" value="<?= $titulo ?>" required><br>
    <label>Precio</label><input type="number" step="any" name="precio" value="<?= $precio ?>" required><br>
    <label>Consola</label><input type="text" name="consola" value="<?= $consola ?>" required><br>
    <label>Minimo de jugadores</label><input type="number" name="minJug" value="<?= $minJug ?>" required><br>
    <label>Maximo de jugadores</label><input type="number" name="maxJug" value="<?= $maxJug ?>" required><br>
    <input type="hidden" name="idCliente" value="<?= $idCliente ?>">
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
