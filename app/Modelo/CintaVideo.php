<?php

namespace Dwes\ProyectoVideoclub\Modelo;
class CintaVideo extends Soporte{
    private int $duracion;
    public function __construct(string $id,string $nombre, float $precio, int $duracion){
        parent::__construct($nombre,$precio);
        $this->id=$id;
        $this->duracion=$duracion;
    }

    public function getTitulo()
    {
        return parent::getTitulo();
    }

    public function getPrecio()
    {
        return parent::getPrecio();
    }

    public function getId(){
        return $this->id;
    }
    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
    }


    public function muestraResumen()
    {
        echo "<br>Película en VHS:";
        echo parent::muestraResumen()." Duración: $this->duracion minutos";
    }
}