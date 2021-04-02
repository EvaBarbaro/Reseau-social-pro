<?php

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/MainController.php';
include __DIR__ . '/controllers/CompanyController.php';
include __DIR__ . '/controllers/ErrorController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', 'MainController#login', 'login');

$router->map('GET', '/inscription', 'CompanyController#register', 'register');
$router->map('GET', '/superAdmin', 'CompanyController#getAll', 'superAdmin');
$router->map('GET', '/monReseau/[i:id]', 'CompanyController#get', 'reseauSingle');
$router->map('POST', '/monReseau/create', 'CompanyController#create', 'reseauCreate');
$router->map('POST', '/monReseau/delete', 'CompanyController#delete', 'superAdminDelete');
$router->map('POST', '/monReseau/update', 'CompanyController#update', 'reseauUpdate');

$match = $router->match();

if ($match != false) {

    $controllerInformations = explode('#', $match['target']);

    $controllerName = $controllerInformations[0];
    $methodName = $controllerInformations[1];

    $controller = new $controllerName($router);

    $controller->$methodName($match['params']);

} else {
    $controller = new ErrorController($router);
    $controller->page404();
}