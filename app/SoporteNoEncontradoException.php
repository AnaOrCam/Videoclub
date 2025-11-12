<?php

namespace Dwes\ProyectoVideoclub\util;
include_once __DIR__."/VideoclubException.php";
class SoporteNoEncontradoException extends \Dwes\ProyectoVideoclub\util\VideoclubException{

    public function __toString():String{
        return parent::__toString(). "No se ha encontrado el soporte<br>";
    }
}
