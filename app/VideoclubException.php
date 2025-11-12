<?php
namespace Dwes\ProyectoVideoclub\util;

use Exception;

class VideoclubException extends Exception{

    public function __toString():String{
        return "<br>Error. ";
    }
};