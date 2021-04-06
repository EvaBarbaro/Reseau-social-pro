<?php

class MainController extends CoreController
{
    public function login($parameters)
    {
        $entrepriseId = $parameters['id'];

        $this->show('login', [
            'title' => 'Social Connect - Connexion',
            'entrepriseId' => $entrepriseId
        ]);
    }
}