<?php

/**
 * Description of adminController
 */

require_once './Modele/modeleUser.php';
require_once './Modele/modeleAdmin.php';

class adminController {

    //Récupère les articles présents dans la BDD et les affiche dans la page d'accueil
    public static function afficherAccueil() {
        $articles = new modeleArticle();
        $articles = $articles->get_allArticles();

        $m = new modeleArticle();
        $compteurNews = $m->getNbNews();

        $m = new modeleArticle();
        $compteurCommentaires = $m->getNbCommentaires();

        require './Vue/accueil.php';
    }

    //Fonction permettant d'afficher un seul article avec ses commentaires
    public static function detailArticle() {
        $id = $_GET['id'];
        $id_article = $_GET['id'];
        $article = new modeleArticle();
        $article = $article->getArticle($id);

        //Permet d'afficher les commentaires pour l'article selectionné
        $commentaires = new modeleCommentaire();
        $commentaires = $commentaires->getCommentaires($id_article);

        require './Vue/detail.php';
    }

    //Fonction permettant d'ajouter un article au blog si Admin(Formulaire)
    public static function insererArticle() {
        $articles = new modeleArticle();
        $modeleArticle = new modeleArticle();

        //Ajout vérification avec Validation $tab
        if (isset($_POST['auteur']) AND isset($_POST['titre']) AND isset($_POST['contenu'])) {
            $id = '';
            $auteur = $_POST['auteur'];
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $date = Date(DATE_W3C);

            $bbcode = array(
                '\[b\](.*?)\[\/b\]' => '<b>$1</b>',
                '\[i\](.*?)\[\/i\]' => '<i>$1</i>',
                '\[u\](.*?)\[\/u\]' => '<u>$1</u>',
                '\[img\](.*?)\[\/img\]' => '<img src="$1"/>',
                '\[url=([^\]]*)\](.*)\[\/url\]' => '<a href="$1" target="_blank">$2</a>',
                ':\)' => '<img src="http://www.auplod.com/u/ouapld6f6a0.png"/>'
            );

            foreach ($bbcode as $key => $value) {
                $contenu = preg_replace('/' . $key . '/', $value, $contenu);
            }
            $contenu = nl2br($contenu);

            if (empty($auteur)) {
                $Erreurs[] = "Veuillez renseigner le champ auteur";
            }
            if (empty($titre)) {
                $Erreurs[] = "Veuillez renseigner le champ titre";
            }
            if (empty($contenu)) {
                $Erreurs[] = "Veuillez renseigner le champ contenu";
            }

            if (!empty($Erreurs)) {

                $Erreurs[] = "Les informations d'insertion de l'article ne sont pas valides ! Redirection vers le formulaire d'ajout.";
                $articles = $modeleArticle->get_allArticles();
                $compteurNews = $modeleArticle->getNbNews();
                $compteurCommentaires = $modeleArticle->getNbCommentaires();
                require('./Vue/accueil.php');
                echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=http://localhost/ProjetBlog/Vue/ajoutNews.php'>";
            } else {
                $articles->insererArticles($id, $auteur, $titre, $contenu, $date);
                $Ok[] = "L'article à été ajouté avec succès !";
                $articles = $modeleArticle->get_allArticles();
                $compteurNews = $modeleArticle->getNbNews();
                $compteurCommentaires = $modeleArticle->getNbCommentaires();
                require './Vue/accueil.php';
            }
        } else {
            $Erreurs[] = "Erreur dans l'insertion de l'article, aucun champs renseignés.";
            echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=http://localhost/ProjetBlog/Vue/ajoutNews.php'>";
        }
    }

    //Fonction permettant de supprimer un article
    public static function SupprimerArticle() {

        $modeleArticle = new modeleArticle();

        if (isset($_POST['form']) && $_POST['form'] == 1) {
            $id = $_POST['id'];
            $articles = $modeleArticle->supprimer_article($id);
            $Ok[] = "Article correctement supprimé.";
        }
        $articles = $modeleArticle->get_allArticles();
        $compteurNews = $modeleArticle->getNbNews();
        $compteurCommentaires = $modeleArticle->getNbCommentaires();

        require_once("./Vue/accueil.php");
    }

    //Fonction qui gère la connexion d'un admin
    public static function connexionAdmin() {

        $tab = ["pseudo" => $_POST['pseudo'],
            "mdp" => $_POST['mdp']];

        $modeleArticle = new modeleArticle();
        $modeleAdmin = new modeleAdmin();
        $pseudo = Validation::nettoyerString($_POST['pseudo']);
        $mdp = Validation::nettoyerString($_POST['mdp']);

        if (Validation::valider($tab)) {

            $connexion = $modeleAdmin->connexionAdmin($pseudo, $mdp);

            if ($connexion == null) {
                $Erreurs[] = "Les informations de connexion ne sont pas valides ! Redirection vers le formulaire de connexion.";
                $articles = $modeleArticle->get_allArticles();
                $compteurNews = $modeleArticle->getNbNews();
                $compteurCommentaires = $modeleArticle->getNbCommentaires();
                require('./Vue/accueil.php');
                echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=http://localhost/ProjetBlog/Vue/connexionSiteA.php'>";
            } else {

                $Ok[] = "Connexion réussie !";

                $articles = $modeleArticle->get_allArticles();
                $compteurNews = $modeleArticle->getNbNews();
                $compteurCommentaires = $modeleArticle->getNbCommentaires();

                require("./Vue/accueil.php");
            }
        } else {
            $Erreurs[] = "Erreur dans la saisie du pseudo/mot de passe.";
        }
    }

    //Fonction qui gère la déconnexion d'un admin(destruction de la session)
    public static function deconnecterAdmin() {
        session_unset();
        session_destroy();
        adminController::afficherAccueil();
    }

}

//fin class
?>