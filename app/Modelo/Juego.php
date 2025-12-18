<?php

namespace Dwes\ProyectoVideoclub\Modelo;
class Juego extends Soporte{

    private int $minNumJugadores;
    private int $maxNumJugadores;
    public function __construct(string $id,$titulo, $precio, public string $consola, int $minNumJugadores, int $maxNumJugadores){
        parent::__construct($titulo,$precio);
        $this->minNumJugadores=$minNumJugadores;
        $this->maxNumJugadores=$maxNumJugadores;
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function getMinNumJugadores(): int
    {
        return $this->minNumJugadores;
    }

    public function setMinNumJugadores(int $minNumJugadores): void
    {
        $this->minNumJugadores = $minNumJugadores;
    }

    public function getMaxNumJugadores(): int
    {
        return $this->maxNumJugadores;
    }

    public function setMaxNumJugadores(int $maxNumJugadores): void
    {
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function getConsola(): string
    {
        return $this->consola;
    }

    public function setConsola(string $consola): void
    {
        $this->consola = $consola;
    }

    public function getTitulo()
    {
        return parent::getTitulo();
    }

    public function getPrecio()
    {
        return parent::getPrecio();
    }

    public function muestraJugadoresPosibles(){
        if($this->maxNumJugadores==1) return "Para 1 jugador";
        elseif ($this->maxNumJugadores !=  $this->minNumJugadores) return "De $this->minNumJugadores a $this->maxNumJugadores jugadores";
        else return "Para $this->maxNumJugadores jugadores";
    }

    public function muestraResumen(){
        echo "<br>Juego para PS4:";
        echo  parent::muestraResumen() . $this->muestraJugadoresPosibles();
    }
}
