<?php
namespace Dwes\ProyectoVideoclub\Util\LogFactory;


use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogFactory{
    public static function createLogger(string $nombre, string $archivo):LoggerInterface{
        $log=new Logger($nombre);
        $log->pushHandler(new StreamHandler($archivo,Level::Debug));
        return $log;
    }
}