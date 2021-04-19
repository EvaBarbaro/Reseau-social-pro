<?php

require_once __DIR__.'/../dao/entrepriseDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class CompanyController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entrepriseList = $entrepriseDao->getAll();
        $this->show('entreprises', [
            'title' => 'Social Connect - Back Office',
            'entrepriseList' => $entrepriseList
        ]);
    }

    // public function get($parameters)
    // {
    //     $entrepriseId = $parameters['id'];

    //     $DBData = new DBData();
    //     $db = $DBData->getConnection();

    //     $entrepriseDao = new entrepriseDao($db);
    //     $entreprise = $entrepriseDao->get($entrepriseId);

    //     $this->show('singleEntreprise', [
    //         'title' => 'Social Connect - Mon Réseau',
    //         'entreprise' => $entreprise
    //     ]);
    // }

    public function register()
    {
        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }

    public function create()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $utilisateurDao = new utilisateurDao($db);
        $compteDao = new compteDao($db);

        $entreprise = new entreprise();
        $utilisateur = new utilisateur();

        $containsDigit   = preg_match('/\d/',          $_POST['motdepasse']);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $_POST['motdepasse']);

        if (isset($_POST['identreprise'], $_POST['designation'], $_FILES["logo"], $_POST['description'], $_POST['url'], $_POST['statut'], $_POST['idutilisateur'], $_POST['nomutilisateur'], $_POST['motdepasse'], $_POST['mail'], $_POST['role'], $_POST['statut'], $_POST['identreprise'])) {
            $entreprise->setIdEntreprise($_POST['identreprise']);
            $entreprise->setDesignation($_POST['designation']);
    
            if (isset($_FILES["logo"])) {
      
                $uniqueFileName = uniqid();
                $extension = end(explode(".", $_FILES["logo"]["name"]));
                $tempname = $_FILES["logo"]["tmp_name"];    
                $folder =  __DIR__ . '/../public/logoImages/'.$uniqueFileName.'.'.$extension;
              
                if (move_uploaded_file($tempname, $folder))  {
                    $entreprise->setLogo($uniqueFileName.'.'.$extension);
                }
            }
    
            $entreprise->setDescription($_POST['description']);
            $entreprise->setUrl($_POST['url']);
            $entreprise->setStatut($_POST['statut']);
        
            $utilisateur->setIdUtilisateur($_POST['idutilisateur']);
            $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
            $utilisateur->setMotDePasse($_POST['motdepasse']);
            $utilisateur->setMail($_POST['mail']);
            $utilisateur->setRole($_POST['role']);
            $utilisateur->setStatut($_POST['statut']);
            $utilisateur->setIdEntreprise($_POST['identreprise']);

            $to      = $_POST['mail'];
    
            $subject = "Votre adresse de connexion SocialConnect";
    
            $message = "
            <html>
            <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Votre adresse de connexion SocialConnect</title>
            </head>
            <body>
            <h1>Bonjour ".$_POST['nomutilisateur']."</h1>
            <p>Veuillez trouver votre lien de connexion ci-dessous pour votre réseau ".$_POST['designation']." :</p>
            <p>".$_POST['url']."</p>
            </body>
            </html>
            ";
    
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/html; charset=UTF-8";
    
            $headers[] = "To: ".$_POST['nomutilisateur']." <".$_POST['mail'].">";
            $headers[] = "From: SocialConnect <social.connect08@gmail.com>";

            if (empty($_POST['identreprise']) || empty($_POST['designation']) || empty($_FILES["logo"]["tmp_name"]) || empty($_POST['description']) || empty($_POST['url']) || empty($_POST['statut']) || empty($_POST['idutilisateur']) || empty($_POST['nomutilisateur']) || empty($_POST['motdepasse']) || empty($_POST['mail']) || empty($_POST['role']) || empty($_POST['statut']) || empty($_POST['identreprise'])){
                $_SESSION['message'] = "<div class='alert alert-danger'>Veuillez remplir tous les champs !</div>";
                header('Location: '.pathUrl());
            } else if ($entrepriseDao->getDesignation($entreprise) !== 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Ce nom de réseau existe déjà !</div>";
                header('Location: '.pathUrl());
            } else if ($utilisateurDao->getUsername($utilisateur) !== 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Ce nom d'utilisateur existe déjà !</div>";
                header('Location: '.pathUrl());
            } else if ($utilisateurDao->getMail($utilisateur) !== 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Ce mail existe déjà !</div>";
                header('Location: '.pathUrl());
            } else if (strlen($_POST['motdepasse']) < 8) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir 8 caractères minimum.</div>
";
                header('Location: '.pathUrl());
            } else if (!$containsDigit) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir un chiffre.</div>
";
                header('Location: '.pathUrl());
            } else if (!$containsSpecial) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe doit contenir un caractère spécial.</div>
";
                header('Location: '.pathUrl());
            } else {
                if (mail($to, $subject, $message, implode("\r\n", $headers))) {
                    $_SESSION['message'] = "<div class='alert alert-success'>Un mail de confirmation vous a été envoyé, vous pouvez accéder à votre réseau !</div>";

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
        
                    $entrepriseDao->create($entreprise);
            
                    $utilisateurDao->create($utilisateur);
            
                    $compteDao->create($compte);
                    
                    header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/login');
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger'>Cette adresse mail n'est pas valide, votre réseau n'a pas pu être créé.</div>";
                    header('Location: '.pathUrl());
                }
            }
        }
    }

    public function update()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);

        $entreprise = new entreprise();

        $entreprise->setIdEntreprise($_POST['identreprise']);
        $entreprise->setDesignation($_POST['designation']);

        if (isset($_FILES["logo"])) {
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["logo"]["name"]));
            $tempname = $_FILES["logo"]["tmp_name"];    
            $folder = __DIR__ . '/../public/logoImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $entreprise->setLogo($uniqueFileName.'.'.$extension);
            }
        } else {
            $entreprise->setLogo($_POST['logo']);
        }

        $entreprise->setDescription($_POST['description']);
        $entreprise->setUrl($_POST['url']);

        if ($_POST['statut'] == NULL) {
            $entreprise->setStatut(0);
        } else {
            $entreprise->setStatut($_POST['statut']);
        }

        $entrepriseDao->update($entreprise);

        header('Location: '.pathUrl().'superAdmin');
    }

    public function delete()
    {
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entrepriseDao->delete($entrepriseId);

        header('Location: '.pathUrl().'superAdmin');
    }
}