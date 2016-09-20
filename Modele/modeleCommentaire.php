<?php

/**
 * Description of modele
 */
require_once './DAL/commentaireGateway.php';

//require_once './Controleur/config.php';


class modeleCommentaire {
    
     
    public function getCommentaires($id_article){
        global $username,$password;
        
        $bd = new commentaireGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $commentaires = $bd->getCommentaires($id_article);
    }
    
    public function insererCommentaire($id,$auteur, $commentaire, $date, $id_article){
        global $username,$password;

        $bd = new commentaireGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $bd->insererCommentaire($id,$auteur, $commentaire, $date, $id_article);
    }
    

}