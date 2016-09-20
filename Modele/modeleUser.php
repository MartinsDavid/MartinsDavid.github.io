<?php

/**
 * Description of modele
 */
require_once './DAL/userGateway.php';

class modeleUser {

    public function connexionUser($pseudo,$mdp) {
        global $username,$password;

        $b = new userGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        
        $res = $b->connexionSiteU($pseudo,$mdp);
        if($res!=NULL){
            $_SESSION['typeUser'] = $res;
            $_SESSION['pseudoUser'] = $_POST['pseudo'];
        }        
        return $res;
    }
    
    
    public function inscription($pseudo,$mail,$mdp) {
       global $username,$password;

        $b = new userGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        return $b->inscriptionSite($pseudo,$mail,$mdp);
    }
    

}
