<?php

namespace Dwes\ProyectoVideoclub;
class CintaVideo extends Soporte{
    private int $duracion;
    public function __construct(string $nombre, float $precio, int $duracion){
        parent::__construct($nombre,$precio);
        $this->duracion=$duracion;
    }
    public function muestraResumen()
    {
        echo "<br>Película en VHS:";
        echo parent::muestraResumen()." Duración: $this->duracion minutos";
    }
}