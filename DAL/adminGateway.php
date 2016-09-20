<?php

/**
 * Description of adminGateway
 */

require_once 'Connexion.php';

class adminGateway {

    private $con;

    public function __construct(Connexion $con) {
        $this->con = $con;
    }
   
    public function connexionSiteA($pseudo,$mdp) {
        
        $query = "SELECT role FROM admin WHERE pseudo=:pseudo AND mdp=:mdp";
        
        $this->con->executeQuery($query, array(
                        ':pseudo' => array($pseudo, PDO::PARAM_STR),
                        ':mdp' => array($mdp, PDO::PARAM_STR)));


        return $this->con->getResults();
    }
   
}
