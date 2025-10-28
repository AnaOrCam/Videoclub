<?php

namespace Dwes\ProyectoVideoclub;
class Dvd extends Soporte{

    private string $formatPantalla;
    public function __construct(string $titulo, float $precio, public string $idiomas, string $formatPantalla){
        parent::__construct($titulo, $precio);
        $this->formatPantalla=$formatPantalla;
    }

    public function muestraResumen(){
        echo "<br>Película en DVD: ";
        echo parent::muestraResumen()."Idiomas: $this->idiomas <br>Formato Pantalla: $this->formatPantalla";
    }
}
