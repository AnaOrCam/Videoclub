<?php

//include_once "Videoclub.php";
//include_once "Modelo/Cliente.php";
//include_once "Modelo/Soporte.php";
//include_once "Modelo/CintaVideo.php";
//include_once "Modelo/Dvd.php";
//include_once "Modelo/Juego.php";
include_once __DIR__."/../vendor/autoload.php";
use Dwes\ProyectoVideoclub\clienteDataAccess\DAOCliente;
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOCintaVideo;
use Dwes\ProyectoVideoclub\soporteDataAccess\DAODvd;
use Dwes\ProyectoVideoclub\soporteDataAccess\DAOJuego;
use \Dwes\ProyectoVideoclub\Modelo\Cliente;
use \Dwes\ProyectoVideoclub\Modelo\CintaVideo;
use \Dwes\ProyectoVideoclub\Modelo\Juego;
use \Dwes\ProyectoVideoclub\Modelo\Dvd;

session_start();

$DAOCliente=new DAOCliente();
$DAOCintavideo=new DAOCintaVideo();
$DAOJuego=new DAOJuego();
$DAODvd=new DAODvd();
if ($_SESSION['tipo']=='admin') {
    echo 'Bienvenido ' . $_SESSION['usuario'] . '<br><br>';

    $videoclub = $_SESSION['videoclub'] ?? [];
//    $listaUsuarios = $_SESSION['listaUsuarios'];
    $listaUsuariosDao=$DAOCliente->getAll();
    $listaUsuarios=array_map(fn($user)=>new Cliente($user['id'],$user['name'],$user['user'],$user['pass'],$user['maxConcurrente'],$user['numSoportesAlquilados']),$listaUsuariosDao);

    $listaSoportes=[];
    $listaCintavideoDao=$DAOCintavideo->getAll();
    $listaCintavideo=array_map(fn($cinta)=>new CintaVideo($cinta['id'],$cinta['nombre'],$cinta['precio'],$cinta['duracion']),$listaCintavideoDao);

    $listaDvdDao=$DAODvd->getAll();
    $listaDvd=array_map(fn($dvd)=>new Dvd($dvd['id'],$dvd['titulo'],$dvd['precio'],$dvd['idiomas'],$dvd['formato']),$listaDvdDao);

    $listaJuegoDao=$DAOJuego->getAll();
    $listaJuego=array_map(fn($juego)=>new Juego($juego['id'],$juego['titulo'],$juego['precio'],$juego['consola'],$juego['minNumJug'],$juego['maxNumJug']),$listaJuegoDao);

    $listaSoportesDao=[...$listaJuegoDao,...$listaCintavideoDao,...$listaDvdDao];
    $listaSoportes=[...$listaJuego,...$listaCintavideo,...$listaDvd];

    echo "<br><em>Lista de Clientes:</em><br>";
    echo "<ul>";
    foreach ($listaUsuarios as $cliente) {
        echo '<li>'.$cliente->__toString().
            '<a id="'.$cliente->getUsuario().'" href="formUpdateCliente.php?usuario='.$cliente->getUsuario().'">✏️</a>
            <a id="'.$cliente->getUsuario().'" href="removeCliente.php?id='.$cliente->getNumero().'">❌</a>
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
//    echo "</ul>";
//    echo "<br><em>Lista de Soportes:</em><br>";
//    echo "<ul type='none'>";
//    foreach ($videoclub->getProductos() as $soporte) {
//        echo "<li>" . $soporte->muestraResumen() . "</li>";
//    }
//    echo "</ul>";

    echo "</ul>";
    echo "<br><em>Lista de Soportes:</em><br>";
    echo "<ul type='none'>";
    foreach ($listaSoportes as $i => $soporte) {
        echo '<li>' . $soporte->muestraResumen() . '<a href="formUpdateSoporte.php?id='.$soporte->getId().'">✏️</a>
            <a href="removeSoporte.php?id='.$soporte->getId().'">❌</a>';
        echo ($listaSoportesDao[$i]['idCliente'])? '<a href="devolverSoporte.php?id='.$soporte->getId().'">Devolver</a>':'<a href="formPrestarSoporte.php?id='.$soporte->getId().'">Prestar</a>';
    }
    echo "</li></ul>";
    echo '<br><br><a href="formCreateCliente.php">Dar de alta a un nuevo cliente</a>';
    echo '<br><br><a href="addSoporteForm.php">Dar de alta un nuevo soporte</a>';
    echo '<br><br><a href="Logout.php">Cerrar Sesión</a>';
}else{
    echo "No estas autorizado para acceder al panel de administración";
}