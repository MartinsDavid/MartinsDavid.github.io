<?php

/**
 * Description of frontController
 */
require_once 'adminController.php';
require_once 'userController.php';

//Frontcontroler qui gère toutes les actions(admin, user)
class frontController {

    function __construct() {

        session_start();

        try {

            $a = modeleAdmin::isAdmin();

            $Erreurs = array();
            $Ok = array();
            $actionAdmin = array('insererArticle', 'supprimerArticle', 'connexionAdmin', 'deconnecterAdmin', 'modifierArticle');
            $actionUser = array('connexionUser', 'deconnexionUser', 'inscription', 'ajouterCommentaire', 'detailArticle', 'Rechercher', 'compteurNews', 'contacter', 'listeComplete', NULL);


            if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
                $action = NULL;
            } else {
                $action = $_REQUEST['action'];
            }


            Validation::nettoyerString($action);

            if (in_array($action, $actionAdmin)) {
                if ($a = NULL) {
                    require './Vue/connexionSiteA.php';
                } else {
                    switch ($action) {
                        case NULL :
                            adminController::afficherAccueil();
                            break;
                        case 'insererArticle':
                            adminController::insererArticle();
                            break;
                        case 'supprimerArticle':
                            adminController::SupprimerArticle();
                            break;
                        case 'connexionAdmin' :
                            adminController::connexionAdmin();
                            break;
                        case 'detailArticleA' :
                            adminController::detailArticle();
                            break;
                        case 'rechercheA':
                            adminController::rechercherA();
                            break;
                        case 'deconnecterAdmin' :
                            adminController::deconnecterAdmin();
                            break;
                    }
                }
            } elseif (in_array($action, $actionUser)) {
                switch ($action) {
                    case NULL :
                        userController::afficherAccueil();
                        break;
                    case 'ajouterCommentaire':
                        userController::ajouterCommentaire();
                        break;
                    case 'detailArticle':
                        userController::detailArticle();
                        break;
                    case 'connexionUser':
                        userController::connexionUser();
                        break;
                    case 'deconnexionUser':
                        userController::deconnexionUser();
                        break;
                    case 'inscription':
                        userController::Inscription();
                        break;
                    case 'Rechercher':
                        userController::rechercher();
                        break;
                    case 'contacter':
                        userController::contacter();
                        break;
                    case 'listeComplete':
                        userController::listeComplete();
                        break;
                }
            }
        }
        
        catch (PDOException $e)
        {
            $Erreurs[] = "Erreur PDO inattendue !";
            userController::afficherAccueil();
        }
        
        catch (Exception $e2)
        {
            $Erreurs[] = "Erreur inattendue !";
            userController::afficherAccueil();
        }
    }

}
