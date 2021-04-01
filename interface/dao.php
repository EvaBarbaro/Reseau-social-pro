<?php

interface dao {
    public function get(int $id);
    public function getAll();
    public function update(int $id,array $object);
    public function create();
    public function delete(int $id);
}