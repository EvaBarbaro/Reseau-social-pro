<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require './altorouter/AltoRouter.php';

include __DIR__ . '/utils/DBData.php';

include __DIR__ . '/controllers/CoreController.php';
include __DIR__ . '/controllers/LoginController.php';
include __DIR__ . '/controllers/CompanyController.php';
include __DIR__ . '/controllers/ImageController.php';
include __DIR__ . '/controllers/UserController.php';
include __DIR__ . '/controllers/AccountController.php';
include __DIR__ . '/controllers/SocialNetworkController.php';
include __DIR__ . '/controllers/ErrorController.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/superAdmin/login', 'LoginController#loginAdmin', 'loginAdmin');
$router->map('POST', '/superAdmin/loggedAdmin', 'LoginController#loggedAdmin', 'loggedAdmin');
$router->map('POST', '/superAdmin/logoutAdmin', 'LoginController#logoutAdmin', 'logoutAdmin');

$router->map('GET', '/monReseau/[i:id]/login', 'LoginController#login', 'login');
$router->map('POST', '/monReseau/[i:id]/logged', 'LoginController#logged', 'logged');
$router->map('POST', '/monReseau/logout', 'LoginController#logout', 'logout');

$router->map('GET', '/', 'CompanyController#register', 'register');

//ici, le id est le idutilisateur de la table utilisateur (table compte)
$router->map('GET', '/monCompte/[i:id]/mesImages', 'ImageController#getAll', 'mesImages');  
// $router->map('GET', '/monCompte/[i:id]/MonMur', 'ImageController#getAllMonMur', 'MonMur');  

$router->map('POST', '/monImage/create', 'ImageController#create', 'monImageCreate');
$router->map('POST', '/monImage/delete', 'ImageController#delete', 'monImageDelete');
$router->map('POST', '/monImage/update', 'ImageController#update', 'monImageUpdate');
$router->map('GET', '/imageEnCreation', 'ImageController#preCreate', 'monImageEnCreation');

$router->map('POST', '/monReseau/[i:id]/LikeUnlikePublication', 'SocialNetworkController#LikeUnlikePublication', 'reseauSingleLikeUnlikePublication');
$router->map('POST', '/monReseau/[i:id]/createPublication', 'SocialNetworkController#createPublication', 'reseauSinglecreatePublication');

$router->map('POST', '/monReseau/[i:id]/LikeUnlikeCommentaire', 'SocialNetworkController#LikeUnlikeCommentaire', 'reseauSingleLikeUnlikeCommentaire');
$router->map('POST', '/monReseau/[i:id]/createCommentaire', 'SocialNetworkController#createCommentaire', 'reseauSinglecreateCommentaire');

$router->map('GET', '/superAdmin', 'CompanyController#getAll', 'superAdmin');
$router->map('GET', '/monReseau/[i:id]', 'SocialNetworkController#home', 'reseauSingle');
$router->map('POST', '/mesPublications/update', 'SocialNetworkController#updatePublication', 'publicationUpdate');
$router->map('POST', '/mesPublications/delete', 'SocialNetworkController#deletePublication', 'publicationDelete');
$router->map('POST', '/monReseau/create', 'CompanyController#create', 'reseauCreate');
$router->map('POST', '/monReseau/delete', 'CompanyController#delete', 'superAdminDelete');
$router->map('POST', '/monReseau/update', 'CompanyController#update', 'reseauUpdate');

$router->map('GET', '/monReseau/[i:id]/inscription', 'UserController#register', 'userRegister');
$router->map('GET', '/monReseau/[i:id]/admin', 'UserController#getAll', 'admin');
$router->map('GET', '/monCompte/[i:id]', 'UserController#get', 'userSingle'); // Mon Compte
$router->map('GET', '/monCompte/[i:id]/monMotDePasse', 'UserController#getPass', 'userSinglePassword');
$router->map('GET', '/monCompte/[i:id]/mesPublications', 'SocialNetworkController#getPublicationByUser', 'userAllPublications');
$router->map('POST', '/monCompte/create', 'UserController#create', 'userCreate');
$router->map('POST', '/monCompte/delete', 'UserController#delete', 'userDelete');
$router->map('POST', '/monCompte/deleteUser', 'UserController#deleteUser', 'userDeleteSingle');
$router->map('POST', '/monCompte/update', 'UserController#update', 'userUpdate');
$router->map('POST', '/monCompte/updateAdmin', 'UserController#updateAdmin', 'userUpdateAdmin');
$router->map('POST', '/monCompte/updatePassword', 'UserController#updatePass', 'userUpdatePassword');

$router->map('GET', '/monReseau/[i:id]/admin/informations', 'AccountController#getAll', 'adminAccounts');
$router->map('GET', '/monCompte/[i:id]/mesInformations', 'AccountController#get', 'accountSingle');
$router->map('POST', '/mesInformations/update', 'AccountController#update', 'accountUpdate');

$match = $router->match();

if ($match !== false) {
    if ($match['target'] === "ImageController#getAll" && empty($_SESSION)) {
        $match = false;
    } else if ($match['target'] === "SocialNetworkController#getPublicationByUser" && empty($_SESSION)) {
        $match = false;
    } else if ($match['target'] === "SocialNetworkController#home" && empty($_SESSION) || $match['target'] === "SocialNetworkController#home" && $match['params']['id'] !== $_SESSION['identreprise']) {
        $match = false;
    } else if ($match['target'] === "UserController#get" && empty($_SESSION) || $match['target'] === "UserController#get" && $match['params']['id'] !== $_SESSION['idutilisateur']) {
        $match = false;
    } else if ($match['target'] === "AccountController#get" && empty($_SESSION) || $match['target'] === "AccountController#get" && $match['params']['id'] !== $_SESSION['idutilisateur']) {
        $match = false;
    } else if ($match['target'] === "UserController#getPass" && empty($_SESSION) || $match['target'] === "UserController#getPass" && $match['params']['id'] !== $_SESSION['idutilisateur']) {
        $match = false;
    }  else if ($match['target'] === "UserController#getAll" && empty($_SESSION) || $match['target'] === "UserController#getAll" && $match['name'] !== $_SESSION['role']) {
        $match = false;
    } else if ($match['target'] === "UserController#getAll" && empty($_SESSION) || $match['target'] === "UserController#getAll" && $match['params']['id'] !== $_SESSION['identreprise']) {
        $match = false;
    }  else if ($match['target'] === "CompanyController#getAll" && empty($_SESSION) || $match['target'] === "CompanyController#getAll" && $match['name'] !== $_SESSION['role']) {
        $match = false;
    }
}

if ($match) {
    //explode()  retourne un tableau de chaînes de caractères, chacune d'elle étant 
    //une sous-chaîne du paramètre string extraite en utilisant le séparateur separator.
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