<?php
namespace Dwes\ProyectoVideoclub\soporteDataAccess;
require __DIR__."/../database/Database.php";
include_once __DIR__ ."/../database/conf.env.php";
include_once __DIR__."/../Modelo/Dvd.php";
class DAODvd{

    private $db;


    public function __construct(){
        $this->db = new \Database(DSN,USER,PASS);
    }
    public function insert($dvd,$idCliente=null) : int{

        $sql = "INSERT INTO dvd VALUES (null,:name, :price, :format , :languajes, :idCliente);";

        $params = [
            ":name"=> $dvd->getTitulo(),
            ":price" => $dvd->getPrecio(),
            ":format" => $dvd->getFormatPantalla(),
            ":languajes" => $dvd->getIdiomas(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
    public function delete(int $id) : int{

        $sql = "DELETE FROM dvd WHERE id = :id;";

        $params = [
            ":id" => $id
        ];

        return $this->db->executeUpdate($sql, $params);
    }

    public function getAll() : array{

        $sql = "SELECT * FROM dvd;";

        $params = [
        ];

        return $this->db->executeQuery($sql, $params);
    }

    public function update($dvd,$idCliente=null) : int{

        $sql = "UPDATE dvd SET titulo=:name, precio=:price, formato=:format, idiomas=:languajes, idCliente=:idCliente WHERE id=:id;";

        $params = [
            ":id"=>$dvd->getId(),
            ":name"=> $dvd->getTitulo(),
            ":price" => $dvd->getPrecio(),
            ":format" => $dvd->getFormatPantalla(),
            ":languajes" => $dvd->getIdiomas(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
}
