<?php

namespace Dwes\ProyectoVideoclub;

include_once "Soporte.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";
class Videoclub{

    public function __construct(private string $nombre){
        $this->nombre=$nombre;
        $this->productos=[];
        $this->numProductos=0;
        $this->socios=[];
        $this->numSocios=0;
    }

    private function incluirProducto(Soporte $producto){
        $this->productos[]=$producto;
        $this->numProductos++;
        echo "Incluido soporte ".$producto->getNumero()."<br>";
    }

    public function incluirCintaVideo($titulo, $precio, $duracion){
        $videoAux=new CintaVideo($titulo, $precio, $duracion);
        $this->incluirProducto($videoAux);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla){
        $dvdAux=new Dvd($titulo, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvdAux);
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ){
        $juegoAux=new Juego($titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juegoAux);
    }

    public function incluirSocio($nombre, $maxAlquileresConcurrentes=3){
        $clienteAux=new Cliente($nombre, $maxAlquileresConcurrentes);
        $this->socios[]=$clienteAux;
        $this->numSocios++;
        echo "Incluido socio ".$clienteAux->getNumero()."<br>";
    }

    public function listarProductos(){
        echo "<br>Listado de los ".$this->numProductos." productos disponibles:";
        foreach ($this->productos as $producto){$producto->muestraResumen();}
    }

    public function listarSocios(){
        echo "<br>Listado de ".$this->numSocios." socios:";
        foreach ($this->socios as $socio){$socio->muestraResumen();}
    }

    public function alquilarSocioProducto($numeroCliente, $numeroSoporte){
        $socioAux=null;
        $soporteAux=null;
        foreach ($this->socios as $socio){
            if ($socio->getNumero() == $numeroCliente) $socioAux=$socio;
        }
        foreach ($this->productos as $producto){
            if ($producto->getNumero() == $numeroSoporte) $soporteAux=$producto;
        }
        if ($socioAux==null) echo "No existe el número de socio";
        if ($soporteAux==null) echo "No existe el numero de soporte";
        if ($soporteAux!= null && $socioAux!= null) $socioAux->alquilar($soporteAux);
        return $this;
    }

}
