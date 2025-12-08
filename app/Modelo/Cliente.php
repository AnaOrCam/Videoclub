<?php

namespace Dwes\ProyectoVideoclub\Modelo;

//include_once("Soporte.php");
//include_once __DIR__ . "/../util/SoporteYaAlquiladoException.php";
//include_once __DIR__ . "/../util/CupoYaSuperadoException.php";
//include_once __DIR__ . "/../util/SoporteNoEncontradoException.php";
use Dwes\ProyectoVideoclub\Util\LogFactory\LogFactory;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class Cliente{

    private int $numero;
    private array $soportesAlquilados;
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;
    private $log;

    private static $numSocios=0;
    public  function __construct(public string $nombre, public string $usuario, public string $pass,int $maxAlquilerConcurrente=3){
        $this->numero=self::$numSocios++;
        $this->usuario=$usuario;
        $this->pass=$pass;
        $this->maxAlquilerConcurrente=$maxAlquilerConcurrente;
        $this->soportesAlquilados=[];
        $this->numSoportesAlquilados=0;
        //$this->log=new Logger("VideoclubLogger");
        //$this->log->pushHandler(new RotatingFileHandler(__DIR__.'/../Logs/logs',7,Level::Debug));
        $this->log= LogFactory::createLogger("VideoclubLogger","/../Logs/logs");
    }

    public function getAlquileres(): array{
        return $this->soportesAlquilados;
    }

    public function getMaxAlquilerConcurrente(): int
    {
        return $this->maxAlquilerConcurrente;
    }

    public function setMaxAlquilerConcurrente(int $maxAlquilerConcurrente): void
    {
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function setPass(string $pass): void
    {
        $this->pass = $pass;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }


    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero(int $numero){
        $this->numero=$numero;
    }

    public function getNumSoportesAlquilados(){
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen(){
        echo "<br>".$this->nombre." tiene ". count($this->soportesAlquilados)." alquileres activos";
    }

    public function tieneAlquilado(Soporte $s):bool{
        foreach ($this->soportesAlquilados as $soporte => $valor){
            if ($s->getNumero()==$valor) return true;
        }
        return false;
    }

    public function alquilar(Soporte $s):bool{
        if (in_array($s,$this->soportesAlquilados) || count($this->soportesAlquilados)==$this->maxAlquilerConcurrente){
            if (in_array($s,$this->soportesAlquilados)){
                $this->log->warning("El soporte ya está alquilado.");
                throw new util\SoporteYaAlquiladoException("",0,null,$s);
            }
            if (count($this->soportesAlquilados)==$this->maxAlquilerConcurrente){
                $this->log->warning("El usuario ya tiene el cupo de alquileres subierto.");
                throw new util\CupoYaSuperadoException();
            }
            return false;
        }else{
            $this->numSoportesAlquilados++;
            $this->soportesAlquilados[]=$s;
            $s->alquilado=true;
            $this->log->info("Alquilado soporte a: $this->nombre");
            //echo "<br><strong>Alquilado soporte a: </strong> $this->nombre";
            $s->muestraResumen();
            return true;
        }
    }

    public function devolver(int $numSoporte):bool{
        $alquilada=false;
        for ($i=0; $i<count($this->soportesAlquilados); $i++){
            if ($this->soportesAlquilados[$i]->getNumero()==$numSoporte){
                $alquilada=true;
                $this->soportesAlquilados[$i]->alquilado=false;
                array_splice($this->soportesAlquilados,$i,1);
                $this->numSoportesAlquilados--;
                $this->log->info("El soporte ha sido devuelto");
                //echo "<br>El soporte ha sido devuelto";
                return true;
            }
        }
        if (!$alquilada) throw new util\SoporteNoEncontradoException();

        return false;
    }

    public function listaAlquileres():void{
        echo "<br>$this->nombre tiene ". count($this->soportesAlquilados). "alquileres activos:";
        foreach ($this->soportesAlquilados as $soporte){
            $soporte->muestraResumen();
        }
    }

    public function __toString():string{
        return $this->nombre."\nID: ".$this->numero."\nUsuario: ".$this->usuario." Soportes alquilados: ".$this->numSoportesAlquilados;
    }
}