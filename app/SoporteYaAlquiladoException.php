<?php

namespace Dwes\ProyectoVideoclub\util;
include_once "modelo/Soporte.php";
include_once __DIR__."/VideoclubException.php";
class SoporteYaAlquiladoException extends \Dwes\ProyectoVideoclub\util\VideoclubException{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null, $soporte){
        parent::__construct($message, $code, $previous);
        $this->soporte=$soporte;
    }

    public function __toString():String{
        $aux=$this->soporte->getTitulo();
        return parent::__toString()." El soporte ". $aux." ya ha sido alquilado<br>";
    }
}
