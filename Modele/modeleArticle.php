<?php

/**
 * Description of modeleArticle
 */
require_once './DAL/articleGateway.php';


class modeleArticle {
    
     
    public function get_allArticles() {
       global $username,$password;

        $b = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $articles = $b->getArticles();
    }
    
    public function getArticle($id){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $article = $bd->getArticle($id);
    }
    
    public function insererArticles($id,$auteur,$titre, $contenu,$date) {
        global $username,$password;

        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $bd->insererArticle($id,$auteur, $titre, $contenu, $date);
    }
    
    
    public function supprimer_article($id){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $bd->supprimerUnArticle($id);
    }
    
    public function getCommentaires($id){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $commentaires = $bd->getCommentaires($id);
    }
    
    public function getRecherches($recherche){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $recherches = $bd->getRecherches($recherche);
    }
    
    public static function getNbNews(){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $nbNews = $bd->getNbNews();
    }
    
    public static function getNbCommentaires(){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $nbNews = $bd->getNbCommentaires();
    }
    
    public function getUserCommentaires($id){
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $userCommentaires = $bd->getUserCommentaires($id);        
    }
    
    public function listeComplete($page)
    {
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $bd->getListe($page);      
    }
    
    public function getNbPages()
    {
        global $username,$password;
        
        $bd = new articleGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        $nbTitres = $bd->getNbTitres();

        return ceil($nbTitres/2);
    }
    

    
}