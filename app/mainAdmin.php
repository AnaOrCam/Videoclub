<?php

//include_once "Videoclub.php";
//include_once "Modelo/Cliente.php";
//include_once "Modelo/Soporte.php";
//include_once "Modelo/CintaVideo.php";
//include_once "Modelo/Dvd.php";
//include_once "Modelo/Juego.php";
include_once __DIR__."/../vendor/autoload.php";

use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
use \Dwes\ProyectoVideoclub\Modelo\Cliente;

session_start();

$DAOCliente=new DAOCliente();
if ($_SESSION['tipo']=='admin') {
    echo 'Bienvenido ' . $_SESSION['usuario'] . '<br><br>';

    $videoclub = $_SESSION['videoclub'] ?? [];
//    $listaUsuarios = $_SESSION['listaUsuarios'];
    $listaUsuariosDao=$DAOCliente->getAll();
    $listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);

    echo "<br><em>Lista de Clientes:</em><br>";
    echo "<ul>";
    foreach ($listaUsuarios as $cliente) {
        echo '<li>'.$cliente->__toString().
            '<a id="'.$cliente->getUsuario().'" href="formUpdateCliente.php?usuario='.$cliente->getUsuario().'">Editar cliente</a>
            <a id="'.$cliente->getUsuario().'" href="removeCliente.php?id='.$cliente->getNumero().'">Eliminar cliente</a>
            </li><br>';
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