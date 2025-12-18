<?php
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
$id=$_GET['id'] ?? 0;
$DAODvd=new DAODvd();

$dvd=$DAODvd->getDvd($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Cinta Video</title>
</head>
<body>

<?php
$titulo=$dvd['titulo'];
$precio=$dvd['precio'];
$formato=$dvd['formato'];
$idiomas=$dvd['idiomas'];
$idCliente=$dvd['idCliente'];

?>

<form action="updateDvd.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nombre</label><input type="text" name="nombre" value="<?= $titulo ?>" required><br>
    <label>Precio</label><input type="number" step="any" name="precio" value="<?= $precio ?>" required><br>
    <label>Formato</label><input type="text" name="formato" value="<?= $formato ?>" required><br>
    <label>Idiomas</label><input type="text" name="idiomas" value="<?= $idiomas ?>" required><br>
    <input type="hidden" name="idCliente" value="<?= $idCliente ?>">
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
