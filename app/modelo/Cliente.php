<?php

namespace Dwes\ProyectoVideoclub;

include_once("Soporte.php");
include_once __DIR__."/../SoporteYaAlquiladoException.php";
include_once __DIR__."/../CupoYaSuperadoException.php";
include_once __DIR__."/../SoporteNoEncontradoException.php";
class Cliente{

    private int $numero;
    private array $soportesAlquilados;
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;

    private static $numSocios=0;
    public  function __construct(public string $nombre, int $maxAlquilerConcurrente=3){
        $this->numero=self::$numSocios++;
        $this->maxAlquilerConcurrente=$maxAlquilerConcurrente;
        $this->soportesAlquilados=[];
        $this->numSoportesAlquilados=0;
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
            if (in_array($s,$this->soportesAlquilados)) throw new util\SoporteYaAlquiladoException("",0,null,$s);
            if (count($this->soportesAlquilados)==$this->maxAlquilerConcurrente) throw new util\CupoYaSuperadoException();
            return false;
        }else{
            $this->numSoportesAlquilados++;
            $this->soportesAlquilados[]=$s;
            $s->alquilado=true;
            echo "<br><strong>Alquilado soporte a: </strong> $this->nombre";
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
                echo "<br>El soporte ha sido devuelto";
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
}