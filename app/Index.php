<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
if (isset($_SESSION['accesoIncorrecto'])) echo "Usuario o contraseña incorrectos<br>";

?>

<form action="Login.php" method="post">
    <label>Usuario</label><input type="text" name="usuario" required><br>
    <label>Contraseña</label><input type="password" name="pass" required><br>
    <p><button type="submit">Enviar</button></p>
</form>
</body>
</html>