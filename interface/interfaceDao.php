<?php


interface interfaceDao {
    function get($id);
    function getAll();
    function update(object $model);
    function create(object $model);
    function delete($id);
}
