<?php

class CoreController
{
    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    protected function show($viewName, $viewVars = [])
    {
        $router = $this->router;

        $dbData = new DBData;

        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/' . $viewName . '.php';
        include __DIR__ . '/../views/footer.php';
    }

    protected function send404()
    {
        $errorController = new ErrorController($this->router);
        $errorController->page404();
    }
}