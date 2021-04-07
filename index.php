<?php

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/MainController.php';
include __DIR__ . '/controllers/CompanyController.php';
include __DIR__ . '/controllers/ImageController.php';
include __DIR__ . '/controllers/UserController.php';
include __DIR__ . '/controllers/AccountController.php';
include __DIR__ . '/controllers/ErrorController.php';
include __DIR__ . '/controllers/SocialNetworkController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/monReseau/[i:id]/login', 'MainController#login', 'login');

$router->map('GET', '/', 'CompanyController#register', 'register');

$router->map('GET', '/socialHome', 'SocialNetworkController#home', 'socialHome');

$router->map('GET', '/mesImages', 'ImageController#getAll', 'mesImages');
$router->map('GET', '/monImage/[i:id]', 'ImageController#get', 'monImage');
$router->map('POST', '/monImage/create', 'ImageController#create', 'monImageCreate');
$router->map('POST', '/monImage/delete', 'ImageController#delete', 'monImageDelete');
$router->map('POST', '/monImage/update', 'ImageController#update', 'monImageUpdate');

$router->map('GET', '/superAdmin', 'CompanyController#getAll', 'superAdmin');
$router->map('GET', '/monReseau/[i:id]', 'CompanyController#get', 'reseauSingle');
$router->map('POST', '/monReseau/create', 'CompanyController#create', 'reseauCreate');
$router->map('POST', '/monReseau/delete', 'CompanyController#delete', 'superAdminDelete');
$router->map('POST', '/monReseau/update', 'CompanyController#update', 'reseauUpdate');

$router->map('GET', '/monReseau/[i:id]/inscription', 'UserController#register', 'userRegister');
$router->map('GET', '/monReseau/[i:id]/admin', 'UserController#getAll', 'admin');
$router->map('GET', '/monCompte/[i:id]', 'UserController#get', 'userSingle');
$router->map('POST', '/monCompte/create', 'UserController#create', 'userCreate');
$router->map('POST', '/monCompte/delete', 'UserController#delete', 'userDelete');
$router->map('POST', '/monCompte/update', 'UserController#update', 'userUpdate');

$router->map('GET', '/monReseau/admin/informations', 'AccountController#getAll', 'adminAccounts');
$router->map('GET', '/monCompte/[i:id]/mesInformations', 'AccountController#get', 'accountSingle');
$router->map('POST', '/mesInformations/update', 'AccountController#update', 'accountUpdate');

$match = $router->match();

if ($match != false) {
    //explode()  retourne un tableau de chaînes de caractères, chacune d'elle étant 
    // une sous-chaîne du paramètre string extraite en utilisant le séparateur separator.
    $controllerInformations = explode('#', $match['target']);

    $controllerName = $controllerInformations[0];
    $methodName = $controllerInformations[1];

    $controller = new $controllerName($router);
    
    $controller->$methodName($match['params']); 
    //$match['params'] --> prend un paramètre si il y en a un, par exemple le id de get(id).

} else {
    $controller = new ErrorController($router);
    $controller->page404();
}
