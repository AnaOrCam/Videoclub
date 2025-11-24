<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuevo cliente</title>
</head>
<body>

<?php
if (isset($_SESSION['errorRegistro'])) echo $_SESSION['errorRegistro']."<br>";

?>

<form action="createCliente.php" method="post">
    <label>Nombre y apellidos</label><input type="text" name="nombre" required><br>
    <label>Nombre de usuario</label><input type="text" name="usuario" required><br>
    <label>Contraseña</label><input type="password" name="pass" required><br>
    <label>Máximo de alquileres concurrentes</label><input type="text" name="alqConc" required><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>