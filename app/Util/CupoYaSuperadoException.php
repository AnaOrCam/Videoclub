<?php

namespace Dwes\ProyectoVideoclub\Util;
//include_once __DIR__ . "/VideoclubException.php";
class CupoYaSuperadoException extends \Dwes\ProyectoVideoclub\util\VideoclubException{

    public function __toString():String{
        return parent::__toString()."El cupo de soportes ya está cubierto. Por favor devuelva algún soporte antes de realizar un nuevo alquiler.<br>";
    }
}
