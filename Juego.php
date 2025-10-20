<?php

class Juego extends Soporte{

    private int $minNumJugadores;
    private int $maxNumJugadores;
    public function __construct($titulo, $numero, $precio, public string $consola, int $minNumJugadores, int $maxNumJugadores){
        parent::__construct($titulo,$numero,$precio);
        $this->minNumJugadores=$minNumJugadores;
        $this->maxNumJugadores=$maxNumJugadores;
    }

    public function muestraJugadoresPosibles(){
        if($this->maxNumJugadores==1) return "Para 1 jugador";
        elseif ($this->maxNumJugadores !=  $this->minNumJugadores) return "De $this->minNumJugadores a $this->maxNumJugadores jugadores";
        else return "Para $this->maxNumJugadores jugadores";
    }

    public function muestraResumen(){
        echo "<br>Juego para PS4:";
        echo parent::muestraResumen().$this->muestraJugadoresPosibles();
    }
}
