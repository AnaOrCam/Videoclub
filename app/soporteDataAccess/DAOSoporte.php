<?php
namespace Dwes\ProyectoVideoclub\soporteDataAccess;
require_once __DIR__."/../database/Database.php";
include_once __DIR__ ."/../database/conf.env.php";
class DAOSoporte{

    private $db;


    public function __construct(){
        $this->db = new \Database(DSN,USER,PASS);
    }
    public function insert($tipo) : int{

        $sql = "INSERT INTO soporte VALUES (null,:tipo);";

        $params = [
            ":tipo"=> $tipo
        ];

        return $this->db->executeUpdate($sql, $params);
    }
    public function delete(int $id) : int{

        $sql = "DELETE FROM soporte WHERE id = :id;";

        $params = [
            ":id" => $id
        ];

        return $this->db->executeUpdate($sql, $params);
    }

    public function getAll() : array{

        $sql = "SELECT * FROM soporte;";

        $params = [
        ];

        return $this->db->executeQuery($sql, $params);
    }

    public function getSoporte($id){

        $sql = "SELECT * FROM soporte WHERE id=:id;";

        $params = [
            ":id"=>$id
        ];

        return $this->db->executeOneQuery($sql, $params);
    }
}
