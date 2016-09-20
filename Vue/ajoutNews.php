<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire de création d'un article</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen,projection" />
        <link rel="stylesheet" href="./css/style2.css" type="text/css" media="screen,projection" />
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="header">
            <h1 class="right">Mon Blog</h1>
            <h1><a href="../index.php">Mon blog</a></h1>
        </div>
        <ul id="nav">
            <li class="right">
                <form method="GET" action="../index.php">
                    <input name="recherche" type="text" />
                    <input name="action" value="Rechercher" type="submit">
                </form>
            </li>
            <li class="right">
                <?php if (!isset($_SESSION['pseudoAdmin'])) { ?>
                    <a class="bouton" href="../Vue/connexionSiteA.php?action=connexionAdmin">Connexion Admin</a>
                    <a class="bouton" href="./Vue/connexionSiteU.php?action=connexionUser">Connexion User</a>
                    <a class="bouton" href="./Vue/inscription.php?action=inscription">Inscription</a>
                <?php } ?>
                <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                    <a><?php echo "Bonjour " . $_SESSION['pseudoAdmin']; ?></a>
                    <a class="bouton" href="./index.php?action=deconnecterAdmin">Déconnexion</a>
                <?php } ?>
            </li>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="../Vue/Apropos.php">A propos</a></li>
            <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                <li><a class="bouton" href="../Vue/ajoutNews.php?action=insererArticle">Insertion</a></li>
            <?php } ?>
            <li><a href="../Vue/contact.php">Contact</a></li>
            <li><a href="../index.php?action=listeComplete&page=0">Tous les articles</a></li>
        </ul>
        <br>
        <br>
        <br>
        <br>

        <div class="login-block">
            <center>
                <h1>Rédaction d'un nouvel article</h1>
                <br>
                <form method="post" action="../index.php?action=insererArticle">
                    <div class="news">
                        <div class="titre_zone_texte">Auteur :</div>
                        <div class="zone_texte"><input type="text" name="auteur"  size="50" maxlength="50"></div>

                        <div class="titre_zone_texte">Titre de l'article :</div>
                        <div class="zone_texte"><input type="text" name="titre"  size="100" maxlength="255"></div>

                        <div class="titre_zone_texte">Contenu de l'article :</div>
                        <div class="zone_texte"><textarea name="contenu"  rows="10" cols="60"></textarea></div>
                    </div>
                    <button>Ajouter l'article</button>
                    <br>
                </form>
            </center>
        </div>
        <br>
        <br>

        <div id="footer">
            <p>Copyright 2015.<br />
                © All your copyright information here.</p>
        </div>
    </body>
</html>
