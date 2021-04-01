<?php

interface publication {
    function get(publication $publication);
    function getAll(publication $publication);
    function update(publication $publication);
    function create(publication $publication);
    function delete(publication $publication);
}