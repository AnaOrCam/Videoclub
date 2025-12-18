<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
$id=$_GET['id'] ?? 0;
$DAOCintavideo=new DAOCintaVideo();

$cinta=$DAOCintavideo->getCintavideo($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Cinta Video</title>
</head>
<body>

<?php
$titulo=$cinta['nombre'];
$precio=$cinta['precio'];
$duracion=$cinta['duracion'];
$idCliente=$cinta['idCliente'];

?>

<form action="updateCintavideo.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nombre</label><input type="text" name="nombre" value="<?= $titulo ?>" required><br>
    <label>Precio</label><input type="number" step="any" name="precio" value="<?= $precio ?>" required><br>
    <label>Duracion</label><input type="number" name="duracion" value="<?= $duracion ?>" required><br>
    <input type="hidden" name="idCliente" value="<?= $idCliente ?>">
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>


