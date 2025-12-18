<?php
include_once __DIR__."/../vendor/autoload.php";
session_start();

$id=$_GET['id'] ?? 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuevo juego</title>
</head>
<body>

<?php
if (isset($_SESSION['error'])) echo $_SESSION['error']."<br>";

?>

<form action="addJuego.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nombre</label><input type="text" name="nombre" required><br>
    <label>Precio</label><input type="number" step="any" name="precio" required><br>
    <label>Consola</label><input type="text" name="consola" required><br>
    <label>Minimo de jugadores</label><input type="number" name="minJug" required><br>
    <label>Maximo de jugadores</label><input type="number" name="maxJug" required><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
