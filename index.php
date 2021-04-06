<?php

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/MainController.php';
include __DIR__ . '/controllers/CompanyController.php';

include __DIR__ . '/controllers/ImageController.php';

include __DIR__ . '/controllers/ErrorController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', 'MainController#login', 'login');

$router->map('GET', '/inscription', 'CompanyController#register', 'register');
$router->map('GET', '/superAdmin', 'CompanyController#getAll', 'superAdmin');

$router->map('GET', '/mesImages', 'ImageController#getAll', 'mesImages');
$router->map('GET', '/monImage/[i:id]', 'ImageController#get', 'monImage');
$router->map('GET', '/monImage/update', 'ImageController#get', 'monImageUpdate');


$router->map('GET', '/monReseau/[i:id]', 'CompanyController#get', 'reseauSingle');
$router->map('POST', '/monReseau/create', 'CompanyController#create', 'reseauCreate');
$router->map('POST', '/monReseau/delete', 'CompanyController#delete', 'superAdminDelete');
$router->map('POST', '/monReseau/update', 'CompanyController#update', 'reseauUpdate');

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