<?php

/**
 * Description of gateway
 */
require_once 'Connexion.php';

class commentaireGateway {

    private $con;

    public function __construct(Connexion $con) {
        $this->con = $con;
    }

    public function getCommentaires($id_article) {
        
        $query = "SELECT * FROM commentaires WHERE id_article = :id_article";
        $commentaires = $this->con->executeQuery($query, array('id_article' => array($id_article, PDO::PARAM_INT)));
        return $commentaires = $this->con->getResults();
  
    }
    
    public function insererCommentaire($id,$auteur, $commentaire, $date, $id_article){
        try {
            $query = 'INSERT INTO commentaires(id,auteur,commentaire,date,id_article) VALUES(:id,:auteur,:commentaire,:date,:id_article)';
            $date = Date(DATE_W3C);
            return $this->con->executeQuery($query, array(
                        ':id' => array($id, PDO::PARAM_STR),
                        ':auteur' => array($auteur, PDO::PARAM_STR),
                        ':commentaire' => array($commentaire, PDO::PARAM_STR),
                        ':date' => array($date, PDO::PARAM_STR),
                        ':id_article' => array($id_article, PDO::PARAM_STR)
            ));
        } catch (PDOException $e) {
            echo "Echec :" . $e->getMessage() . "\n";
        }
    }
    
    
}
