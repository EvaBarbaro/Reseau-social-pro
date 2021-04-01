<?php

class MainController extends CoreController
{
    public function login()
    {
        $dbData = new DBData();

        $this->show('login', [
            'title' => 'Social Connect - Connexion'
        ]);
    }

    public function register()
    {
        $dbData = new DBData();

        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }
}