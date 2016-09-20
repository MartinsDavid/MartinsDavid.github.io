<!DOCTYPE html>
<html>
    <head>
        <title> Mon blog</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="./Vue/css/style.css" type="text/css" media="screen,projection" />
        <link rel="stylesheet" href="./css/style2.css" type="text/css" media="screen,projection" />
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'/>
    </head>
    <body>
        <div id="header">
            <h1 class="right">Mon Blog</h1>
            <h1><a href="index.php">Mon blog</a></h1>
        </div>
        <ul id="nav">
            <li class="right">
                <form method="GET" action="./index.php">
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
            <li><a href="./index.php?action=listeComplete&page=0">Tous les articles</a></li>
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
                </p>
            </div>
            <center>
                <?php
                foreach ($article as $valeur) {
                    ?>
                    <h1> 
                        <?php echo $valeur['titre']; ?>
                    </h1>
                    <p> 
                        <?php echo $valeur['contenu']; ?>
                    </p>
                    <br>
                    <div>
                        <div class="details">
                            <p> Posté par <a href="#"><?php echo $valeur['auteur']; ?></a> le <a><?php echo $valeur['date']; ?></a>
                            </p>
                        </div>
                        <br>
                        <br>
                        <br>
                        <h1>
                            Commentaires
                        </h1>
                        <HR width="500px" align=center>
                        <br>
                        <div>
                            <?php foreach ($commentaires as $commentaire) {
                                ?>
                                <div>
                                    <p>
                                        Commentaire posté par <font color="red"><?php echo $commentaire['auteur']; ?></font> le <font color="red"><?php echo $commentaire['date']; ?></font>
                                    </p>
                                </div>
                                <div>
                                    <?php echo $commentaire['commentaire']; ?>
                                </div>
                                <br>
                                <HR width="250px" align=center>
                                <br>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </center>
            </div>
            <?php
        }
        ?>
        <?php require_once("footer.php"); ?>
