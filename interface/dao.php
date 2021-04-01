<?php

interface dao {
    public function get(int $id);
    public function getAll();
    public function update(array $object);
    public function create();
    public function delete(int $id);
}