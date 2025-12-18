<?php
namespace Dwes\ProyectoVideoclub\clienteDataAccess;
require_once __DIR__."/../database/Database.php";
include_once __DIR__."/../Modelo/Cliente.php";



include_once __DIR__ . "/../database/conf.env.php";

class DAOCliente{

    private $db;


    public function __construct(){
        $this->db = new \Database(DSN,USER,PASS);
    }
    public function insert($cliente) : int{

        $sql = "INSERT INTO cliente VALUES (null,:name, :user, :pass , :maxConcurrente , :numSoportesAlquilados);";

        $params = [
            ":name"=> $cliente->getNombre(),
            ":user" => $cliente->getUsuario(),
            ":pass" => password_hash($cliente->getPass(),PASSWORD_DEFAULT),
            ":maxConcurrente" => $cliente->getMaxAlquilerConcurrente(),
            ":numSoportesAlquilados"=> $cliente->getNumSoportesAlquilados()
        ];

        return $this->db->executeUpdate($sql, $params);
    }
    public function delete(int $id) : int{

        $sql = "DELETE FROM cliente WHERE id = :id;";

        $params = [
            ":id" => $id
        ];

        return $this->db->executeUpdate($sql, $params);
    }

    public function getAll() : array{

        $sql = "SELECT * FROM cliente;";

        $params = [
        ];

        return $this->db->executeQuery($sql, $params);
    }

    public function getClient($user){

        $sql = "SELECT * FROM cliente WHERE user=:user;";

        $params = [
            ":user"=>$user
        ];

        return $this->db->executeOneQuery($sql, $params);
    }

    public function update($cliente) : int{

        $sql = "UPDATE cliente SET name=:name, user=:user, pass=:pass, maxConcurrente=:maxConcurrente, numSoportesAlquilados=:numSoportesAlquilados WHERE id=:id;";

        $params = [
            ":id" => $cliente->getNumero(),
            ":name"=> $cliente->getNombre(),
            ":user" => $cliente->getUsuario(),
            ":pass" => password_hash($cliente->getPass(),PASSWORD_DEFAULT),
            ":maxConcurrente" => $cliente->getMaxAlquilerConcurrente(),
            ":numSoportesAlquilados"=> $cliente->getNumSoportesAlquilados()
        ];

        return $this->db->executeUpdate($sql, $params);
    }

}
