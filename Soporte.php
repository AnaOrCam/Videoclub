<?php

class Soporte{

    private float $precio;
    public function __construct(public string $titulo, protected int $numero, float $precio){
        $this->precio=$precio;
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

    public function muestraResumen(){
        echo "<br><i> $this->titulo </i><br> $this->precio € (IVA no incluido)<br>";
    }

}
