<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Modelo\CintaVideo;
use Dwes\ProyectoVideoclub\Modelo\Cliente;
use Dwes\ProyectoVideoclub\Modelo\Dvd;
use Dwes\ProyectoVideoclub\Modelo\Juego;
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\VideoclubException;
use Dwes\ProyectoVideoclub\Modelo\Soporte;
use Dwes\ProyectoVideoclub\Util\LogFactory\LogFactory;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

//
//include_once "Modelo/Soporte.php";
//include_once "Modelo/CintaVideo.php";
//include_once "Modelo/Dvd.php";
//include_once "Modelo/Juego.php";
//include_once "Modelo/Cliente.php";

class Videoclub{
    private $log;
    public function __construct(private string $nombre){
        $this->nombre=$nombre;
        $this->productos=[];
        $this->numProductos=0;
        $this->socios=[];
        $this->numSocios=0;
        $this->numProductosAlquilados=0;
        $this->numTotalAlquileres=0;
        //$this->log=new Logger("VideoclubLogger");
        //$this->log->pushHandler(new RotatingFileHandler(__DIR__."/Logs/logs",7,Level::Debug));
        $this->log=LogFactory::createLogger("VideoclubLogger",__DIR__."/Logs/logs");
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function getSocios(): array
    {
        return $this->socios;
    }

    public function getAlquileresPorCliente (int $id):array{
        return $this->buscarSocioPorId($id)->getAlquileres();
    }

    private function incluirProducto(Soporte $producto){
        $this->productos[]=$producto;
        $this->numProductos++;
        $this->log->info("Incluido soporte",['numeroSoporte'=>$producto->getNumero()]);
        //echo "Incluido soporte ".$producto->getNumero()."<br>";
    }

    public function buscarSocioPorId(int $id):?Cliente{
        foreach ($this->socios as $socio){
            if ($socio->getNumero()==$id) return $socio;
        }
        return null;
    }

    public function editarClientePorAdmin($cliente,$nombre,$usuario,$pass,$maxAlquConcurrentes):bool{
        $cliente->setNombre($nombre);
        $cliente->setUsuario($usuario);
        $cliente->setPass($pass);
        $cliente->setMaxAlquilerConcurrente($maxAlquConcurrentes);
        return true;
    }

    public function editarClientePorCliente($cliente,$nombre,$usuario,$pass):bool{
        $cliente->setNombre($nombre);
        $cliente->setUsuario($usuario);
        $cliente->setPass($pass);
        return true;
    }

    public function incluirCintaVideo($titulo, $precio, $duracion){
        $videoAux=new CintaVideo($titulo, $precio, $duracion);
        $this->incluirProducto($videoAux);
        return $videoAux;
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla){
        $dvdAux=new Dvd($titulo, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvdAux);
        return $dvdAux;
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ){
        $juegoAux=new Juego($titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juegoAux);
        return $juegoAux;
    }

    public function incluirSocio($nombre, $usuario,$pass,$maxAlquileresConcurrentes=3){
        $clienteAux=new Cliente($nombre, $usuario,$pass, $maxAlquileresConcurrentes);
        $this->socios[]=$clienteAux;
        $this->numSocios++;
        $this->log->info("Incluido socio",['numSocio'=>$clienteAux->getNumero()]);
        //echo "Incluido socio ".$clienteAux->getNumero()."<br>";
        return $clienteAux;
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
        try {
            $socioAux = null;
            $soporteAux = null;
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) $socioAux = $socio;
            }
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numeroSoporte) $soporteAux = $producto;
            }
            if ($socioAux == null){
                $this->log->warning("Cliente no encontrado",['numCliente'=>$numeroCliente]);
                throw new util\ClienteNoEncontradoException();
            }
            if ($soporteAux == null){
                $this->log->warning("Soporte no encontrado",['numSoporte'=>$numeroSoporte]);
                throw new util\SoporteNoEncontradoException();
            }
            $socioAux->alquilar($soporteAux);
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;
        }catch (VideoclubException $ve){
            echo $ve->__toString();
        }
        return $this;
    }
    public function alquilarSocioProductos(int $numeroCliente, array $numeroSoportes){
        try {
            $socioAux = null;
            $arraySoportesAlquilar=[];
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) $socioAux = $socio;
            }
            foreach ($numeroSoportes as $numeroSoporte) {
                $existe=false;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroSoporte){
                        $existe=true;
                        if (!$producto->alquilado) $arraySoportesAlquilar[]=$producto;
                        else{
                            $this->log->warning("Soporte ya alquilado",['numSoporte'=>$numeroSoporte]);
                            throw new SoporteYaAlquiladoException("",0,null,$producto);
                        }
                    }
                }
                if (!$existe) {
                    $this->log->warning("Soporte no encontrado", ['numSoporte' => $numeroSoporte]);
                    throw new util\SoporteNoEncontradoException();
                }
            }
            if ($socioAux == null) {
                $this->log->warning("Cliente no encontrado", ['numCliente' => $numeroCliente]);
                throw new util\ClienteNoEncontradoException();
            }
            foreach ($arraySoportesAlquilar as $soporte){
                $socioAux->alquilar($soporte);
                $this->numProductosAlquilados++;
                $this->numTotalAlquileres++;
            }
        }catch (VideoclubException $ve){
            echo $ve->__toString();
        }
        return $this;
    }
    public function devolverSocioProducto($numeroCliente, $numeroSoporte){
        try {
            $socioAux = null;
            $soporteAux = null;
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) $socioAux = $socio;
            }
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numeroSoporte) $soporteAux = $producto;
            }
            if ($socioAux == null){
                $this->log->warning("Cliente no encontrado",['numCliente'=>$numeroCliente]);
                throw new util\ClienteNoEncontradoException();
            }
            if ($soporteAux == null) {
                $this->log->warning("Soporte no encontrado", ['numSoporte' => $numeroSoporte]);
                throw new util\SoporteNoEncontradoException();
            }
            $socioAux->devolver($numeroSoporte);
            $this->numProductosAlquilados--;
        }catch (VideoclubException $ve){
            echo $ve->__toString();
        }
        return $this;
    }

    public function devolverSocioProductos(int $numeroCliente, array $numeroSoportes){
        try {
            $socioAux = null;
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) $socioAux = $socio;
            }
            foreach ($numeroSoportes as $numeroSoporte) {
                $existe=false;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroSoporte){
                        $existe=true;
                        if (!$producto->alquilado){
                            $this->log->info("El soporte ya está alquilado",['titulo'=>$producto->getTitulo()]);
                            //echo "<br>El soporte ".$producto->getTitulo()." no está alquilado por lo que no se puede devolver";
                        }
                    }
                }
                if (!$existe){
                    $this->log->warning("Soporte no encontrado",['numSoporte'=>$numeroSoporte]);
                    throw new util\SoporteNoEncontradoException();
                }
            }
            if ($socioAux == null){
                $this->log->warning("Cliente no encontrado",['numCliente'=>$numeroCliente]);
                throw new util\ClienteNoEncontradoException();
            }
            foreach ($numeroSoportes as $numero){
                $socioAux->devolver($numero);
                $this->numProductosAlquilados--;
            }
        }catch (VideoclubException $ve){
            echo $ve->__toString();
        }
        return $this;
    }

}
