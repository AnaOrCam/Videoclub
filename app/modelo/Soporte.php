<?php

namespace Dwes\ProyectoVideoclub;

include_once __DIR__ . "/../Resumible.php";
abstract class Soporte implements Resumible {

    private float $precio;
    private static int $numSop=0;
    public function __construct(public string $titulo, float $precio){
        $this->precio=$precio;
        $this->numero=self::$numSop++;
        $this->alquilado=false;
    }

    public function getPrecio(){
        return $this -> precio;
    }

    public function getNumero(){
        return $this -> numero;
    }

    public function getPrecioConIva(){
        return $this -> precio*1.21;
    }

    public function getTitulo(){
        return $this -> titulo;
    }

    public function muestraResumen(){
        echo "<br><i> $this->titulo </i><br> $this->precio € (IVA no incluido)<br>";
    }

}
