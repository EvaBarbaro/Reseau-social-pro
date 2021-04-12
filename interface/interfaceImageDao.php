<?php


interface interfaceImageDao {
    public function get($id);
    public function getAll($id);
    public function update($image);
    public function create($image);
    public function delete($id);
}
