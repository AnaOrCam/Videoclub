<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nuevo soporte</title>
</head>
<body>
<?php
if (isset($_SESSION['errorRegistro'])) echo $_SESSION['errorRegistro']."<br>";

?>
<form action="addSoporte.php" method="post">
    <label>Tipo de soporte: </label>
    <select name="soporte">
        <option value="none">--Selecciona una opción--</option>
        <option value="juego">Juego</option>
        <option value="dvd">Dvd</option>
        <option value="cintavideo">Cinta video</option>
    </select><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>
