<?php

include_once "Videoclub.php";
include_once "modelo/Cliente.php";
include_once "modelo/Soporte.php";
include_once "modelo/CintaVideo.php";
include_once "modelo/Dvd.php";
include_once "modelo/Juego.php";

session_start();

if ($_SESSION['tipo']=='admin') {
    echo 'Bienvenido ' . $_SESSION['usuario'] . '<br><br>';

    $videoclub = $_SESSION['videoclub'] ?? [];
    $listaUsuarios = $_SESSION['listaUsuarios'];

    echo "<br><em>Lista de Clientes:</em><br>";
    echo "<ul>";
    foreach ($videoclub->getSocios() as $cliente) {
        echo '<li>' . $cliente->__toString() . ' <a id="' . $cliente->getUsuario() . '" href="formUpdateCliente.php?usuario=' . $cliente->getUsuario() . '">Editar cliente</a></li><br>';
    }
//foreach ($listaUsuarios as $cliente){
//    echo '<li>'.$cliente.' <a id="'.$cliente.'" href="removeCliente.php?usuario='.$cliente.'">Borrar cliente</a></li><br>';
//    echo '<script>
//            document.getElementById("'.$cliente.'").addEventListener("click", (e)=>{
//                e.preventDefault();
//                let confirm=window.confirm("¿Desea borrar al cliente?");
//                if (confirm)  window.location = e.currentTarget.href;
//            })
//          </script>';
//}
    echo "</ul>";
    echo "<br><em>Lista de Soportes:</em><br>";
    echo "<ul type='none'>";
    foreach ($videoclub->getProductos() as $soporte) {
        echo "<li>" . $soporte->muestraResumen() . "</li>";
    }
    echo "</ul>";
    echo '<br><br><a href="formCreateCliente.php">Dar de alta a un nuevo cliente</a>';
    echo '<br><br><a href="Logout.php">Cerrar Sesión</a>';
}else{
    echo "No estas autorizado para acceder al panel de administración";
}