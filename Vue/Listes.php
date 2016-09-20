<!DOCTYPE html>
<html>
    <head>
        <title> Mon blog</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="./Vue/css/style.css" type="text/css" media="screen,projection" />
    </head>
    <body>

        <div id="header">
            <h1 class="right">Mon Blog</h1>
            <h1><a href="index.php">Mon blog</a></h1>
        </div>
        <ul id="nav">
            <li class="right">
                <form method="GET" action="index.php">
                    <input name="recherche" type="text" />
                    <input name="action" value="Rechercher" type="submit">
                </form>
            </li>
            <li class="right">
                <?php if (!isset($_SESSION['pseudoAdmin']) && !isset($_SESSION['pseudoUser'])) { ?>
                    <a class="bouton" href="./Vue/connexionSiteA.php?action=connexionAdmin">Connexion Admin</a>
                    <a class="bouton" href="./Vue/connexionSiteU.php?action=connexionUser">Connexion User</a>
                    <a class="bouton" href="./Vue/inscription.php?action=inscription">Inscription</a>
                <?php } ?>
                <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                    <a><?php echo "Bonjour " . $_SESSION['pseudoAdmin']; ?></a>
                    <a class="bouton" href="./index.php?action=deconnecterAdmin">Déconnexion</a>
                <?php } ?>
                <?php if (isset($_SESSION['pseudoUser'])) { ?>
                    <a><?php echo "Bonjour " . $_SESSION['pseudoUser']; ?></a>
                    <a class="bouton" href="./index.php?action=deconnexionUser">Déconnexion</a>
                <?php } ?>

            </li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="./Vue/Apropos.php">A propos</a></li>
            <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                <li><a class="bouton" href="./Vue/ajoutNews.php?action=insererArticle">Insertion</a></li>
            <?php } ?>
            <li><a href="./Vue/contact.php">Contact</a></li>
            <li><a href="?action=listeComplete&page=0">Tous les articles</a></li>
        </ul>
        <div class="clear" />
        <div id="sidebar">
            <h2>Informations</h2>
            <p class="news"> Notre blog comporte actuellement <?php echo $compteurNews ?> articles.
                <br>    Il y a <?php echo $compteurCommentaires ?> commentaires au total sur tous les articles. <br>
                <?php if (isset($_SESSION['pseudoUser'])) { ?>
                    Vous avez posté un total de <?php echo $userCommentaires ?> commentaires sur ce Blog.
                <?php } ?>
            </p>
            <p class="news"> Lien utile :</p>
            <p class="news"><a href="http://iutweb.u-clermont1.fr/bienvenue.html" target="_blank"> Site de l'IUT de Clermont-Ferrand »</a> </p>
            <p class="news"> An example of a "latest news" type text area. Here would be the excerpt of the article. You can of course put anything you like here. <a href="#" class="more">Read More »</a> </p>

        </div>
        <div id="content">
            <div>
                <p>
                    <?php
                    if (isset($Erreurs) && !empty($Erreurs)) {
                        echo '<div style="color:red;">';
                        foreach ($Erreurs as $erreur) {
                            echo "Erreur : " . $erreur . "<br/>";
                        }
                        echo '</div>';
                    }
                    ?>
                    <?php
                    if (isset($Ok) && !empty($Ok)) {
                        echo '<div style="color:green;">';
                        foreach ($Ok as $val) {
                            echo "" . $val . "<br/>";
                        }
                        echo '</div>';
                    }
                    ?>
                </p>
            </div>

            <?php
            foreach ($liste as $article) {
                ?>
                <br>
                <h2>
                    <?php { ?>
                        <?php { ?>
                            <form action="index.php" method="get" accept-charset="utf-8">
                                <label class="control-label" for="submit"></label>
                                <?php
                                echo'<a href="?action=detailArticle&id=' . $article['id'] . '"> ' . $article['titre'] . '</a>';
                                ?>
                                <input type="hidden" name="action" value="detailArticle">	
                                <input type="hidden" name="form" value="1">
                                </div>						
                            </form>
                        <?php } ?>
                    <?php } ?>
                </h2>
                <div class="contenu">
                    <p> 
                        <?php echo $article['contenu']; ?>
                    </p>
                </div>
                <div class="details">
                    <p> Posté par <a href="#"><?php echo $article['auteur']; ?></a> le <a><?php echo $article['date']; ?></a>
                        <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                            <?php { ?>
                            <form style="text-align:right" action="index.php" method="post" accept-charset="utf-8">
                                <label class="control-label" for="submit"></label>
                                <?php
                                echo '<button id="id" name="id"  value="' . $article['id'] . ' ">' . "Supprimer l'article" . '</button>';
                                ?>
                                <input type="hidden" name="action" value="supprimerArticle">	
                                <input type="hidden" name="form" value="1">							
                            </form>
                        <?php } ?>
                    <?php } ?>
                    </p>
                </div>
                <?php if (!isset($_SESSION['pseudoUser']) && !isset($_SESSION['pseudoAdmin'])) { ?>
                    <div class="details">
                        <p>Vous devez être <a href="./Vue/connexionSiteU.php?action=connexionUser">connecté</a> pour poster un nouveau commentaire.</p>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['pseudoUser'])) { ?>
                    <div class="comments">
                        <?php { ?>
                            <center><font FACE="tahoma" color="black" ><h1>Ajouter un commentaire</h1></font></center>
                            <br>
                            <form action="index.php" method="post" accept-charset="utf-8">
                                <label class="control-label" for="submit"></label>
                                <div class="zone_texte"><textarea name="commentaire" required="required" rows="10" cols="60"></textarea></div>
                                <?php
                                echo '<button id="id" name="id"  value="' . $article['id'] . ' ">' . "Commenter" . '</button>';
                                ?>
                                <input type="hidden" name="action" value="ajouterCommentaire">	
                                <input type="hidden" name="form" value="1">						
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
            </p>

        </div>
    </div>
    <?php
}
?>
        <?php
        echo '<div class="navigPage">';
        for ($i = 0; $i < $nbPages; $i++) {
            if ($i == $page)
                echo " " . $i . " ";
            else
                echo ' <a href="?action=listeComplete&page=' . $i . '">' . $i . '</a> ';
        }
        echo '</div>'
        ?>
<br>
<br>
<br>
<div id="footer">
    <p>Copyright 2015-2016 <br/>
        © All your copyright information here.</p>
</div>
</body>
</html>
