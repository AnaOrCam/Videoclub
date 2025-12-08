<?php
namespace Dwes\ProyectoVideoclub\Util;
//include_once __DIR__ . "/VideoclubException.php";
class ClienteNoEncontradoException extends \Dwes\ProyectoVideoclub\util\VideoclubException{

    public function __toString():String{
        return parent::__toString()."Cliente no encontrado<br>";
    }


}
