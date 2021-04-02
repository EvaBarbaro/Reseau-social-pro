<?php


interface interfaceDao {
    public function get($id);
    public function getAll();
    public function update($obj);
    public function create($obj);
    public function delete($id);
}
