<?php

class MainController extends CoreController
{
    public function home()
    {
        $dbData = new DBData();

        $this->show('home', [
            'title' => 'Social Connect'
        ]);
    }
}