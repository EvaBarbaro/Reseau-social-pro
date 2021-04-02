<?php

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/MainController.php';
include __DIR__ . '/controllers/CompanyController.php';
include __DIR__ . '/controllers/ErrorController.php';
include __DIR__ . '/controllers/SocialNetworkController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', 'MainController#login', 'login');
$router->map('GET', '/inscription', 'MainController#register', 'register');
$router->map('GET', '/superAdmin', 'CompanyController#allEntreprise', 'superAdmin');
$router->map('GET', '/superAdmin/[i:id]', 'CompanyController#entreprise', 'superAdminSingle');
$router->map('GET', '/socialHome', 'SocialNetworkController#home', 'socialHome');

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