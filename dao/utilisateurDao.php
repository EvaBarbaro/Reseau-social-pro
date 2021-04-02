<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class utilisateurDao implements dao {
    public $DBData;

    public function get($id) {
        $DBData = new DBData();
    }

    public function getAll() {
        $DBData = new DBData();
    }

    public function update() {
        $DBData = new DBData();
    }

    public function create() {
        $DBData = new DBData();
    }

    public function delete() {
        $DBData = new DBData();
    }
}