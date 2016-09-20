<?php

/**
 * Description of adminController
 */
require './Modele/modeleArticle.php';
require './Modele/modeleCommentaire.php';

class userController {

    //Récupère les articles présents dans la BDD et les affiche dans la page d'accueil
    public static function afficherAccueil() {
        $articles = new modeleArticle();
        $articles = $articles->get_allArticles();

        $compteurNews = modeleArticle::getNbNews();
        $compteurCommentaires = modeleArticle::getNbCommentaires();
        $userCommentaires = userController::getUserCommentaires();

        require './Vue/accueil.php';
    }

    //Fonction permettant la connexion d'un modeleUser
    public static function connexionUser() {

        $tab = ["pseudo" => $_POST['pseudo'],
            "mdp" => $_POST['mdp']];

        $modeleArticle = new modeleArticle();
        $modeleUser = new modeleUser();
        $pseudo = Validation::nettoyerString($_POST['pseudo']);
        $mdp = Validation::nettoyerString($_POST['mdp']);

        if (Validation::valider($tab)) {

            $connexion = $modeleUser->connexionUser($pseudo, $mdp);

            if ($connexion == null) {
                $Erreurs[] = "Les informations de connexion ne sont pas valides ! Redirection vers le formulaire.";
                $articles = $modeleArticle->get_allArticles();
                $compteurNews = modeleArticle::getNbNews();
                $compteurCommentaires = modeleArticle::getNbCommentaires();
                $userCommentaires = userController::getUserCommentaires();
                require('./Vue/accueil.php');
                echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://localhost/ProjetBlog/Vue/connexionSiteU.php'>";
            } else {

                $Ok[] = "Connexion réussie !";

                $articles = $modeleArticle->get_allArticles();
                $compteurNews = modeleArticle::getNbNews();
                $compteurCommentaires = modeleArticle::getNbCommentaires();
                $userCommentaires = userController::getUserCommentaires();
                require("./Vue/accueil.php");
            }
        } else {
            $Erreurs[] = "Erreur dans la saisie du pseudo/mot de passe.";
        }
    }

    //Fonction de deconnexion de l'utilisateur
    public static function deconnexionUser() {
        session_unset();
        session_destroy();
        userController::afficherAccueil();
    }

    //Fonction permettant de s'inscrire sur le site
    public static function Inscription() {

        $modeleUser = new modeleUser();
        $ma = new modeleArticle();
        $tab = ["pseudo" => $_POST['pseudo'],
            "mail" => $_POST['mail'],
            "mdp" => $_POST['mdp']
        ];
        //On vérifie si les champ ont été renseignés
        if (isset($_POST['pseudo']) AND isset($_POST['mail']) AND isset($_POST['mdp']) && Validation::valider($tab)) {
            //Nettoayge des variables
            $pseudo = Validation::nettoyerString($_POST['pseudo']);
            $mail = Validation::nettoyerString($_POST['mail']);
            $mdp = Validation::nettoyerString($_POST['mdp']);
            
            //On regarde si les variables sont vide et on stocke dans un tableau d'erreur si oui
            if (empty($pseudo)) {
                $Erreurs[] = "Votre pseudo n'est pas valide";
            }
            if (empty($mail)) {
                $Erreurs[] = "Votre mail n'est pas valide";
            }
            if (empty($mdp)) {
                $Erreurs[] = "Votre password n'est pas valide";
            }
            //si tab erreur vide on passe a l'inscription
            if (!empty($Erreurs)) {

                $Erreurs[] = "Les informations de connexion ne sont pas valides ! Redirection vers le formulaire d'inscription.";
                $articles = $ma->get_allArticles();
                $compteurNews = modeleArticle::getNbNews();
                $compteurCommentaires = modeleArticle::getNbCommentaires();
                require('./Vue/accueil.php');
                echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=http://localhost/ProjetBlog/Vue/inscription.php'>";
            }
            //renvoi erreur à l'utilisateur et le renvoi au formulaire d'inscription
            else {
                $utilisateur = $modeleUser->inscription($pseudo, $mail, $mdp);
                $Ok[] = "Votre inscription a été validée !";
                $articles = $ma->get_allArticles();
                $compteurNews = modeleArticle::getNbNews();
                $compteurCommentaires = modeleArticle::getNbCommentaires();
                require './Vue/accueil.php';
            }
        }
    }

    //Permet d'afficher l'article selectionnee avec ses commentaires associés
    public static function detailArticle() {
        $id = $_GET['id'];
        $id_article = $_GET['id'];
        $article = new modeleArticle();
        $article = $article->getArticle($id);
        
        $compteurNews = modeleArticle::getNbNews();
        $compteurCommentaires = modeleArticle::getNbCommentaires();
        $userCommentaires = userController::getUserCommentaires();

        //Permet d'afficher les commentaires pour l'article selectionné
        $commentaires = new modeleCommentaire();
        $commentaires = $commentaires->getCommentaires($id_article);
        
        require './Vue/detail.php';
    }

    //Fonction permettant d'ajouter un commentaire à un article du blog
    public static function ajouterCommentaire() {

        $mc = new modeleCommentaire();
        $ma = new modeleArticle();
        $commentaire = $_POST['commentaire'];

        //Ajout verification avec Validation $tab
        if (!empty($commentaire) && isset($_POST['commentaire'])) {
            $id = '';
            $auteur = $_SESSION['pseudoUser'];
            $commentaire = Validation::nettoyerString($_POST['commentaire']);
            $date = Date(DATE_W3C);
            $id_article = Validation::nettoyerString($_POST['id']);

            $mc->insererCommentaire($id, $auteur, $commentaire, $date, $id_article);
            $Ok[] = "Votre commentaire à été ajouté avec succès !";

            $articles = $ma->get_allArticles();
            $compteurNews = modeleArticle::getNbNews();
            $compteurCommentaires = modeleArticle::getNbCommentaires();
            $userCommentaires = userController::getUserCommentaires();
            require './Vue/accueil.php';
        } else {
            $Erreurs[] = "Le champ commentaire est vide. Vous devez le remplir pour poster votre commentaire !";
            $articles = $ma->get_allArticles();
            $compteurNews = modeleArticle::getNbNews();
            $compteurCommentaires = modeleArticle::getNbCommentaires();
            $userCommentaires = userController::getUserCommentaires();
            require('./Vue/accueil.php');
        }
    }

    //Fonction gérant la recherche dans le blog
    public static function rechercher() {
        $m = new modeleArticle();
        $recherche = $_GET['recherche'];

        $recherches = $m->getRecherches($recherche);

        $compteurNews = modeleArticle::getNbNews();
        $compteurCommentaires = modeleArticle::getNbCommentaires();
        $userCommentaires = userController::getUserCommentaires();

        require './Vue/recherche.php';
    }

    //Fonction permettant de récupérer le nombre de commentaire d'un utilisateur
    public static function getUserCommentaires() {
        if (isset($_SESSION['pseudoUser'])) {
            $id = $_SESSION['pseudoUser'];

            $m = new modeleArticle();
            $userCommentaires = $m->getUserCommentaires($id);

            return $userCommentaires;
        }
    }

    //Fonction permmettant d'afficher la liste complète des articles du blog avec pagination(ici 2 articles par page)
    public static function listeComplete() {

        $m = new modeleArticle();

        $tab = ["int" => $_REQUEST['page']];

        $page = $_REQUEST['page'];
        if (empty($page) || !Validation::valider($tab))
            $page = 0;
        $nbPages = $m->getNbPages();
        $liste = $m->listeComplete($page);


        $compteurNews = modeleArticle::getNbNews();
        $compteurCommentaires = modeleArticle::getNbCommentaires();
        $userCommentaires = userController::getUserCommentaires();

        require_once("./Vue/Listes.php");
    }

    //Fonction permettant de contacter l'admin du blog( lui envoyer un mail)
    public static function contacter() {

        ini_set('SMTP', 'smtp.free.fr');
        ini_set('sendmail_from', 'm.david6lesnider@hotmail.fr');

        $modeleArticle = new modeleArticle();

        $mail = $_POST['mail'];
        $sujet = $_POST['sujet'];
        $message = $_POST['message'];

        /////voici la version Mine 
        $headers = "MIME-Version: 1.0\r\n";

        //////ici on détermine le mail en format text 
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

        ////ici on détermine l'expediteur et l'adresse de réponse 
        $headers .= "From: $mail\r\nReply-to : $mail\nX-Mailer:PHP";

        $subject = "$sujet";
        $destinataire = "m.david6lesnider@hotmail.fr"; //remplacez "webmaster@votre-site.com" par votre adresse e-mail
        $body = "$message";
        if (mail($destinataire, $subject, $body, $headers)) {
            $Ok[] = "Votre mail à été envoyé avec succès !";
            $articles = $modeleArticle->get_allArticles();
            $compteurNews = modeleArticle::getNbNews();
            $compteurCommentaires = modeleArticle::getNbCommentaires();
            $userCommentaires = userController::getUserCommentaires();
            require("./Vue/accueil.php");
        } else {
            $Erreurs[] = "Erreur, le mail n'a pas été envoyé !";
        }
    }

}

//fin class
?>