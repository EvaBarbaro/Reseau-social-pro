<?php

interface commentaire {
    function get(commentaire $commentaire);
    function getAll(commentaire $commentaire);
    function update(commentaire $commentaire);
    function create(commentaire $commentaire);
    function delete(commentaire $commentaire);
}