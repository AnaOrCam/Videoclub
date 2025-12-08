<?php
namespace Dwes\ProyectoVideoclub\Util;

use Exception;

class VideoclubException extends Exception{

    public function __toString():String{
        return "<br>Error. ";
    }
};