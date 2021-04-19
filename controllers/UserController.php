<?php

require_once __DIR__.'/../dao/utilisateurDao.php';
require_once __DIR__.'/../dao/compteDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class UserController extends CoreController
{
    public function getAll($parameters)
    {
        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurList = $utilisateurDao->getAll($entrepriseId);

        $this->show('utilisateurs', [
            'title' => 'Social Connect - Réseau Back Office - Utilisateurs',
            'utilisateurList' => $utilisateurList
        ]);
    }

    public function get($parameters)
    {
        $utilisateurId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateur = $utilisateurDao->get($utilisateurId);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($utilisateurId);

        $this->show('singleUtilisateur', [
            'title' => 'Social Connect - Mon Compte',
            'utilisateur' => $utilisateur,
            'compte' => $compte
        ]);
    }

    public function getPass($parameters)
    {
        $utilisateurId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateur = $utilisateurDao->get($utilisateurId);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($utilisateurId);

        $this->show('singlePassword', [
            'title' => 'Social Connect - Mon Compte',
            'utilisateur' => $utilisateur,
            'compte' => $compte
        ]);
    }

    public function register($parameters)
    {
        $entrepriseId = $parameters['id'];

        $this->show('utilisateurRegister', [
            'title' => 'Social Connect - Inscription',
            'entrepriseId' => $entrepriseId
        ]);
    }

    public function create()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $compteDao = new compteDao($db);

        $utilisateur = new utilisateur();

        $containsDigit   = preg_match('/\d/',          $_POST['motdepasse']);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $_POST['motdepasse']);

        if (isset($_POST['idutilisateur'], $_POST['nomutilisateur'], $_POST['motdepasse'], $_POST['mail'], $_POST['identreprise'])) {
            $utilisateur->setIdUtilisateur($_POST['idutilisateur']);
            $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
            $utilisateur->setMotDePasse($_POST['motdepasse']);
            $utilisateur->setMail($_POST['mail']);
            $utilisateur->setRole('user');
            $utilisateur->setStatut(false);
            $utilisateur->setIdEntreprise($_POST['identreprise']);

            $to      = $_POST['mail'];
    
            $subject = "Votre compte SocialConnect";
    
            $message = "
            <html>
            <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Votre compte SocialConnect</title>
            </head>
            <body>
            <h1>Bonjour ".$_POST['nomutilisateur']."</h1>
            <p>Votre compte a bien été créé mais vous devez attednre qu'un admin valide votre compte pour vous connecter.</p>
            </body>
            </html>
            ";
    
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/html; charset=UTF-8";
    
            $headers[] = "To: ".$_POST['nomutilisateur']." <".$_POST['mail'].">";
            $headers[] = "From: SocialConnect <social.connect08@gmail.com>";

            if (empty($_POST['idutilisateur']) || empty($_POST['nomutilisateur']) || empty($_POST['motdepasse']) || empty($_POST['mail']) || empty($_POST['identreprise'])){
                $_SESSION['message'] = "<div class='alert alert-danger'>Veuillez remplir tous les champs !</div>";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else if ($utilisateurDao->getUsername($utilisateur) !== 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Ce nom d'utilisateur existe déjà !</div>";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else if ($utilisateurDao->getMail($utilisateur) !== 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Ce mail existe déjà !</div>";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else if (strlen($_POST['motdepasse']) < 8) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir 8 caractères minimum.</div>
";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else if (!$containsDigit) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir un chiffre.</div>
";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else if (!$containsSpecial) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir un caractère spécial.</div>
";
                header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
            } else {
                if (mail($to, $subject, $message, implode("\r\n", $headers))) {
                    $_SESSION['message'] = "<div class='alert alert-success'>Un mail de confirmation vous a été envoyé, pour accéder à votre réseau, un admin doit activé votre compte.</div>";

                    $utilisateurDao->create($utilisateur);

                    $compte = new compte
                    (
                        $_POST['idutilisateur'],
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL
                    );
            
                    $compteDao->create($compte);
                    
                    header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/login');
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger'>Cette adresse mail n'est pas valide, votre réseau n'a pas pu être créé.</div>";
                    header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/inscription');
                }
            }
        }
    }

    public function update()
    {
        $utilisateurId = $_POST['idutilisateur'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);
        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->update($utilisateur);

        header('Location: '.pathUrl().'monCompte/'.$utilisateurId);
    }

    public function updatePass()
    {
        $utilisateurId = $_POST['idutilisateur'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $singleUtilisateur = $utilisateurDao->get($utilisateurId);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);

        if (empty($_POST['oldmotdepasse']) || empty($_POST['newmotdepasse'])) {
            session_start();
            $utilisateur->setMotDePasse($singleUtilisateur['motdepasse']);
            $_SESSION['message'] = "<div class='alert alert-danger'>Veuillez remplir tous les champs !</div>"; 
        } else if (hash('sha256', $_POST['oldmotdepasse']) !== $singleUtilisateur['motdepasse']) {
            session_start();
            $utilisateur->setMotDePasse($singleUtilisateur['motdepasse']);
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ne correspond pas à l'ancien !</div>"; 
        } else {
            session_start();
            $utilisateur->setMotDePasse(hash('sha256',$_POST['newmotdepasse']));
            $_SESSION['message'] = "<div class='alert alert-success'>Votre mot de passe a bien été modifié !</div>"; 
        }
        
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->updatePassword($utilisateur);

        header('Location: '.pathUrl().'monCompte/'.$utilisateurId.'/monMotDePasse');
    }

    public function updateAdmin()
    {
        $entrepriseId = $_POST['identreprise'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);
        $utilisateur->setRole($_POST['role']);
        
        if ($_POST['statut'] == NULL) {
            $utilisateur->setStatut(0);
        } else {
            $utilisateur->setStatut($_POST['statut']);
        }
        
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->updateAdmin($utilisateur);

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/admin');
    }

    public function delete()
    {
        $utilisateurId = $_POST['idutilisateur'];
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurDao->delete($utilisateurId);

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/admin');
    }

    public function deleteUser()
    {
        $utilisateurId = $_POST['idutilisateur'];
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurDao->delete($utilisateurId);

        session_start();

        $_SESSION['message'] = "<div class='alert alert-danger'>Votre compte a été supprimé !</div>";

        session_destroy();

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/login');
    }
}