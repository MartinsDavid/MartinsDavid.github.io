<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>A propos</title>
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
                <?php if (!isset($_SESSION['pseudoAdmin']) && !isset($_SESSION['pseudoUser'])) { ?>
                    <a class="bouton" href="../Vue/connexionSiteA.php?action=connexionAdmin">Connexion Admin</a>
                    <a class="bouton" href="../Vue/connexionSiteU.php?action=connexionUser">Connexion User</a>
                    <a class="bouton" href="../Vue/inscription.php?action=inscription">Inscription</a>
                <?php } ?>
                <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                    <a><?php echo "Bonjour " . $_SESSION['pseudoAdmin']; ?></a>
                    <a class="bouton" href="../index.php?action=deconnecterAdmin">Déconnexion</a>
                <?php } ?>
                    <?php if (isset($_SESSION['pseudoUser'])) { ?>
                    <a><?php echo "Bonjour " . $_SESSION['pseudoUser']; ?></a>
                    <a class="bouton" href="../index.php?action=deconnexionUser">Déconnexion</a>
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

    </div>
    <br>
    <br>
    <div>
        <center>
            <h2><u> A propos de ce blog </u></h2>
            <br>
            <HR width="500px" align=center>
            <br>
            <br>
            <br>
            <div>

                Ce site a été créé en 2015-2016 dans le cadre d'un projet de PHP.<br><br>
                L'objectif était de créer un blog de news où les visiteurs peuvent intervenir en consultant
                et en commentant les divers articles présents sur celui-ci.
            </div>
        </center>
    </div>
    <br><br>
    <br><br>

    <div id="footer">
        <p>Copyright 2015.<br />
            © All your copyright information here.</p>
    </div>
</body>
</html>
