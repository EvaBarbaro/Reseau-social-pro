<?php


interface interfaceDao {
    public function get($id);
    public function getAll();
    public function update($entreprise);
    public function create($entreprise);
    public function delete($id);
}
