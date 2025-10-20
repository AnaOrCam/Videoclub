<?php
include ("Soporte.php");

class Cliente{

    private int $numero;
    private array $soportesAlquilados;
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;
    public  function __construct(public string $nombre, int $numero, int $maxAlquilerConcurrente=3){
        $this->numero=$numero;
        $this->maxAlquilerConcurrente=$maxAlquilerConcurrente;
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
        echo $this->nombre." tiene ". count($this->soportesAlquilados)."alquileres activos";
    }

    public function tieneAlquilado(Soporte $s):bool{
        foreach ($this->soportesAlquilados as $soporte => $valor){
            if ($s->getNumero()==$valor) return true;
        }
        return false;
    }

    public function alquilar(Soporte $s):bool{
        if (in_array($s,$this->soportesAlquilados) || count($this->soportesAlquilados)==$this->maxAlquilerConcurrente){
            if (in_array($s,$this->soportesAlquilados)) echo "El cliente ya tiene alquilado el soporte <strong>$s->titulo</strong>";
            if (count($this->soportesAlquilados)==$this->maxAlquilerConcurrente) echo "El cliente tiene ". count($this->soportesAlquilados) ." soportes 
            alquilados. No puede alquilar más hasta que no devuelva algo.";
            return false;
        }else{
            $this->numSoportesAlquilados++;
            $this->soportesAlquilados[]=$s;
            echo "<strong>Alquilado soporte a: </strong> $this->nombre";
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
            echo "El soporte ha sido devuelto";
        }else{
            echo "No se ha podido encontrar el soporte en los alquileres de este cliente";
        }
    }

    public function listaAlquileres():void{
        echo $this->nombre." tiene ". count($this->soportesAlquilados). "alquileres activos:";
        foreach ($this->soportesAlquilados as $soporte){
            $soporte->muestraResumen();
        }
    }
}