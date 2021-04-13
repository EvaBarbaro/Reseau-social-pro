<?php


interface interfaceUtilisateurDao {
    public function get($id);
    public function getAll($id);
    public function update($entreprise);
    public function updatePassword($entreprise);
    public function updateAdmin($entreprise);
    public function create($entreprise);
    public function delete($id);
}
