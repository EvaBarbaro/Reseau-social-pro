<?php 

include_once __DIR__.'/../interface/dao.php';
include_once __DIR__.'/../utils/DBData.php';

class entrepriseDao implements dao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get($id) {

    }

    public function getAll() {
        $sql = "SELECT * FROM entreprise";

        $pdoStatement = $this->conn->query($sql);

        $entreprise = $pdoStatement->fetchAll();

        return $entreprise;
    }

    public function update() {

    }

    public function create() {

    }

    public function delete() {

    }
}