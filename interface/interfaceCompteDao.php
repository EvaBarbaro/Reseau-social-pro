<?php


interface interfaceCompteDao {
    public function get($id);
    public function getAll($identreprise);
    public function update($compte);
    public function create($compte);
    public function delete($id);
}
