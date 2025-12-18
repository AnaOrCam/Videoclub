<?php

namespace Dwes\ProyectoVideoclub\Modelo;
class Dvd extends Soporte{

    private string $formatPantalla;
    public function __construct(string $id,string $titulo, float $precio, public string $idiomas, string $formatPantalla){
        parent::__construct($titulo, $precio);
        $this->formatPantalla=$formatPantalla;
        $this->id=$id;
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
    public function getFormatPantalla(): string
    {
        return $this->formatPantalla;
    }

    public function setFormatPantalla(string $formatPantalla): void
    {
        $this->formatPantalla = $formatPantalla;
    }

    public function getIdiomas(): string
    {
        return $this->idiomas;
    }

    public function setIdiomas(string $idiomas): void
    {
        $this->idiomas = $idiomas;
    }



    public function muestraResumen(){
        echo "<br>Película en DVD: ";
        echo parent::muestraResumen()."Idiomas: $this->idiomas <br>Formato Pantalla: $this->formatPantalla";
    }
}
