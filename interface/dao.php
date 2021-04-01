<?php

interface dao {
    function get($id);
    function getAll();
    function update();
    function create();
    function delete();
}