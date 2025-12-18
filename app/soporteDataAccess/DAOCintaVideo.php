<?php
namespace Dwes\ProyectoVideoclub\soporteDataAccess;
require_once __DIR__."/../database/Database.php";
include_once __DIR__ ."/../database/conf.env.php";
include_once __DIR__."/../Modelo/CintaVideo.php";
class DAOCintaVideo{

    private $db;


    public function __construct(){
        $this->db = new \Database(DSN,USER,PASS);
    }
    public function insert($cinta,$idCliente=null) : int{

        $sql = "INSERT INTO cintavideo VALUES (:id,:name, :price, :duration , :idCliente);";

        $params = [
            ":id"=> $cinta->getId(),
            ":name"=> $cinta->getTitulo(),
            ":price" => $cinta->getPrecio(),
            ":duration" => $cinta->getDuracion(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
    public function delete(int $id) : int{

        $sql = "DELETE FROM cintavideo WHERE id = :id;";

        $params = [
            ":id" => $id
        ];

        return $this->db->executeUpdate($sql, $params);
    }

    public function getAll() : array{

        $sql = "SELECT * FROM cintavideo;";

        $params = [
        ];

        return $this->db->executeQuery($sql, $params);
    }

    public function getCintavideo($id){

        $sql = "SELECT * FROM cintavideo WHERE id=:id;";

        $params = [
            ":id"=> $id
        ];

        return $this->db->executeOneQuery($sql, $params);
    }

    public function update($cinta,$idCliente=null) : int{

        $sql = "UPDATE cintavideo SET nombre=:name, precio=:price, duracion=:duration, idCliente=:idCliente WHERE id=:id;";

        $params = [
            ":id"=>$cinta->getId(),
            ":name"=> $cinta->getTitulo(),
            ":price" => $cinta->getPrecio(),
            ":duration" => $cinta->getDuracion(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
}
