<?php
class CintaVideo extends Soporte{
    private int $duracion;
    public function __construct(string $nombre, int $numero, float $precio, int $duracion){
        parent::__construct($nombre,$numero,$precio);
        $this->duracion=$duracion;
    }
    public function muestraResumen()
    {
        echo "<br>Película en VHS:";
        echo parent::muestraResumen()." Duración: $this->duracion minutos";
    }
}