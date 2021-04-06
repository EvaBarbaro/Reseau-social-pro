<?php

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/MainController.php';
include __DIR__ . '/controllers/CompanyController.php';
include __DIR__ . '/controllers/UserController.php';
include __DIR__ . '/controllers/AccountController.php';
include __DIR__ . '/controllers/ErrorController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/monReseau/[i:id]/login', 'MainController#login', 'login');

$router->map('GET', '/', 'CompanyController#register', 'register');
$router->map('GET', '/superAdmin', 'CompanyController#getAll', 'superAdmin');
$router->map('GET', '/monReseau/[i:id]', 'CompanyController#get', 'reseauSingle');
$router->map('POST', '/monReseau/create', 'CompanyController#create', 'reseauCreate');
$router->map('POST', '/monReseau/delete', 'CompanyController#delete', 'superAdminDelete');
$router->map('POST', '/monReseau/update', 'CompanyController#update', 'reseauUpdate');

$router->map('GET', '/monReseau/[i:id]/inscription', 'UserController#register', 'userRegister');
$router->map('GET', '/monReseau/admin', 'UserController#getAll', 'admin');
$router->map('GET', '/monCompte/[i:id]', 'UserController#get', 'userSingle');
$router->map('POST', '/monCompte/create', 'UserController#create', 'userCreate');
$router->map('POST', '/monCompte/delete', 'UserController#delete', 'userDelete');
$router->map('POST', '/monCompte/update', 'UserController#update', 'userUpdate');

$router->map('GET', '/monReseau/admin/informations', 'AccountController#getAll', 'adminAccounts');
$router->map('GET', '/monCompte/[i:id]/mesInformations', 'AccountController#get', 'accountSingle');
$router->map('POST', '/mesInformations/update', 'AccountController#update', 'accountUpdate');

$router->map('GET', '/mesImages', 'ImageController#getAll', 'mesImages');
$router->map('GET', '/monImage/[i:id]', 'ImageController#get', 'monImage');

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
