<?php

namespace Dwes\ProyectoVideoclub;

include_once ("Soporte.php");
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
            if (in_array($s,$this->soportesAlquilados)) echo "<br>El cliente ya tiene alquilado el soporte <strong>$s->titulo</strong>";
            if (count($this->soportesAlquilados)==$this->maxAlquilerConcurrente) echo "<br>El cliente tiene ". count($this->soportesAlquilados) ." soportes 
            alquilados. No puede alquilar más hasta que no devuelva algo.";
            return false;
        }else{
            $this->numSoportesAlquilados++;
            $this->soportesAlquilados[]=$s;
            echo "<br><strong>Alquilado soporte a: </strong> $this->nombre";
            $s->muestraResumen();
            return true;
        }
    }

    public function devolver(int $numSoporte):bool{
        $alquilada=false;
        foreach ($this->soportesAlquilados as $soporte){
            if ($soporte->getNumero()==$numSoporte) $alquilada=true;
        }
        if ($alquilada){
            $this->numSoportesAlquilados--;
            echo "<br>El soporte ha sido devuelto";
            return true;
        }else{
            echo "<br>No se ha podido encontrar el soporte en los alquileres de este cliente";
            return false;
        }
    }

    public function listaAlquileres():void{
        echo "<br>$this->nombre tiene ". count($this->soportesAlquilados). "alquileres activos:";
        foreach ($this->soportesAlquilados as $soporte){
            $soporte->muestraResumen();
        }
    }
}