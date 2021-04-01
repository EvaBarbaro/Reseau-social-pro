<?php

include_once __DIR__.'/../models/entreprise.php';

interface entrepriseInterface {
    function get($id);
    function getAll();
    function update(entreprise $entreprise);
    function create(entreprise $entreprise);
    function delete($id);
}