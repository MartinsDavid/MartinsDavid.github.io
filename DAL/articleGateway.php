<?php


/**
 * Description of gateway
 */
require_once 'Connexion.php';

class articleGateway {

    private $con;

    public function __construct(Connexion $con) {
        $this->con = $con;
    }

    public function getArticles() {
        $query = "SELECT * FROM articles ORDER BY (date) DESC LIMIT 3";

        $articles = $this->con->executeQuery($query);
        return $articles = $this->con->getResults();
    }

    public function getArticle($id) {
        $query = "SELECT * FROM articles WHERE id = :id";
        $article = $this->con->executeQuery($query, array('id' => array($id, PDO::PARAM_INT)));
        return $article = $this->con->getResults();
    }

    public function insererArticle($id, $auteur, $titre, $contenu, $date) {

        try {
            $query = 'INSERT INTO articles(id,auteur, titre, contenu, date) VALUES(:id,:auteur,:titre,:contenu,:date)';
            $date = Date(DATE_W3C);
            return $this->con->executeQuery($query, array(
                        ':id' => array($auteur, PDO::PARAM_STR),
                        ':auteur' => array($auteur, PDO::PARAM_STR),
                        ':titre' => array($titre, PDO::PARAM_STR),
                        ':contenu' => array($contenu, PDO::PARAM_STR),
                        ':date' => array($date, PDO::PARAM_STR)
            ));
        } catch (PDOException $e) {
            echo "Echec :" . $e->getMessage() . "\n";
        }
    }

    public function supprimerUnArticle($id) {

        $query = "DELETE FROM articles WHERE id = :id";
        $this->con->executeQuery($query, array('id' => array($id, PDO::PARAM_INT)));
    }

    

    public function getRecherches($recherche) {
        
        $query = "SELECT * FROM articles WHERE contenu LIKE '%$recherche%' OR titre LIKE '%$recherche%'  ORDER BY (date) DESC";
        $recherches = $this->con->executeQuery($query);
        return $recherches = $this->con->getResults();    
    }
    
    
    public function getNbNews() {
        
        $query = "SELECT COUNT(*) as nbNews FROM articles";
        
        $nbNews = $this->con->executeQuery($query);
        return $nbNews = $this->con->getColonne();
    }
    
    public function getNbCommentaires() {
        
        $query = "SELECT COUNT(*) as nbCommentaires FROM commentaires";
        
        $nbCommentaires = $this->con->executeQuery($query);
        return $nbCommentaires = $this->con->getColonne();
    }
    
    public function getUserCommentaires($id) {
        
        $query = "SELECT COUNT(*) as nbUserCommentaires FROM commentaires WHERE auteur = :id ";
        
        $nbUserCommentaires = $this->con->executeQuery($query,array('id' => array($id, PDO::PARAM_INT)));
        return $nbUserCommentaires = $this->con->getColonne();
      
    }
    
    
    public function getListe($page){
                
		$query = "SELECT * FROM articles ORDER BY (date) DESC LIMIT " . $page*2 . ",2";
		$articles = $this->con->executeQuery($query);
                return $articles = $this->con->getResults();
                
	}
        
    
    public function getNbTitres(){
        
            $query = "SELECT count(*) FROM articles";
            $result = $this->con->executeQuery($query);
            return $result = $this->con->getColonne();
	}
    
    

}
