<?php
namespace Dwes\ProyectoVideoclub\soporteDataAccess;
require_once __DIR__."/../database/Database.php";
include_once __DIR__ ."/../database/conf.env.php";
include_once __DIR__."/../Modelo/Juego.php";
class DAOJuego{

    private $db;


    public function __construct(){
        $this->db = new \Database(DSN,USER,PASS);
    }
    public function insert($juego,$idCliente=null) : int{

        $sql = "INSERT INTO juego VALUES (:id,:name, :price, :platform , :minGamers, :maxGamers, :idCliente);";

        $params = [
            ":id"=> $juego->getId(),
            ":name"=> $juego->getTitulo(),
            ":price" => $juego->getPrecio(),
            ":platform" => $juego->getConsola(),
            ":minGamers" => $juego->getMinNumJugadores(),
            ":maxGamers"=>$juego->getMaxNumJugadores(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
    public function delete(int $id) : int{

        $sql = "DELETE FROM juego WHERE id = :id;";

        $params = [
            ":id" => $id
        ];

        return $this->db->executeUpdate($sql, $params);
    }

    public function getAll() : array{

        $sql = "SELECT * FROM juego;";

        $params = [
        ];

        return $this->db->executeQuery($sql, $params);
    }

    public function getJuego($id){

        $sql = "SELECT * FROM juego WHERE id=:id;";

        $params = [
            ":id"=>$id
        ];

        return $this->db->executeOneQuery($sql, $params);
    }

    public function update($juego,$idCliente=null) : int{

        $sql = "UPDATE juego SET titulo=:name, precio=:price, consola=:platform, minNumJug=:minGamers, maxNumJug=:maxGamers, idCliente=:idCliente WHERE id=:id;";

        $params = [
            ":id"=>$juego->getId(),
            ":name"=> $juego->getTitulo(),
            ":price" => $juego->getPrecio(),
            ":platform" => $juego->getConsola(),
            ":minGamers" => $juego->getMinNumJugadores(),
            ":maxGamers"=>$juego->getMaxNumJugadores(),
            ":idCliente"=> $idCliente
        ];

        return $this->db->executeUpdate($sql, $params);
    }
}
