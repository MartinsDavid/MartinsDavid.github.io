<?php

/**
 * Description of modeleAdmin
 */
require './config/validation.php';
require_once './DAL/adminGateway.php';

class modeleAdmin {
    
    public function connexionAdmin($pseudo,$mdp) {
        global $username,$password;

        $b = new adminGateway(new Connexion('mysql:host=localhost; dbname=blog', $username, $password));
        
        $res = $b->connexionSiteA($pseudo,$mdp);
        if($res!=NULL){
            $_SESSION['typeUser'] = $res;
            $_SESSION['pseudoAdmin'] = $_POST['pseudo'];
        }
                
        return $res;
        
    }
    
    public static function isAdmin(){
        if(isset ($_SESSION['pseudoAdmin'])){
            $login = Validation::nettoyerString($_SESSION['pseudoAdmin']);
            return $login;
        }
        else{
            return NULL;
        }
    }
    
    
}
