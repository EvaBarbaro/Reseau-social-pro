<?php

class MainController extends CoreController
{
    public function login()
    {
        $this->show('login', [
            'title' => 'Social Connect - Connexion'
        ]);
    }
}