<?php

/**
 * Description of userGateway
 */

require_once 'Connexion.php';

class userGateway {
    
    private $con;

    public function __construct(Connexion $con) {
        $this->con = $con;
    }
    
    public function connexionSiteU($pseudo,$mdp) {
        
        $query = "SELECT role FROM utilisateur WHERE pseudo=:pseudo AND mdp=:mdp";
        
        $this->con->executeQuery($query, array(
                        ':pseudo' => array($pseudo, PDO::PARAM_STR),
                        ':mdp' => array($mdp, PDO::PARAM_STR)));


        return $this->con->getResults();
    }
    
    public function inscriptionSite($pseudo, $mail, $mdp) {

        try {
            $query = 'INSERT INTO utilisateur(pseudo, mail, mdp) VALUES(:pseudo,:mail,:mdp)';

            return $this->con->executeQuery($query, array(
                        ':pseudo' => array($pseudo, PDO::PARAM_STR),
                        ':mail' => array($mail, PDO::PARAM_STR),
                        ':mdp' => array($mdp, PDO::PARAM_STR)
            ));
        } catch (PDOException $e) {
            echo "Echec :" . $e->getMessage() . "\n";
        }
    }
    
    
}
    
