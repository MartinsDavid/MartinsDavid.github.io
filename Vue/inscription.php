<!DOCTYPE html>
<html>
    <head>
        <title>Mon blog</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="../Vue/css/style.css" type="text/css" media="screen,projection" />
        <link rel="stylesheet" href="../Vue/css/style2.css" type="text/css" media="screen,projection" />
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
                <a class="bouton" href="../Vue/connexionSiteA.php">Connexion Admin</a>
                <a class="bouton" href="../Vue/connexionSiteU.php">Connexion User</a>
                <a class="bouton" href="../Vue/inscription.php">Inscription</a>
            </li>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="../Vue/Apropos.php">A propos</a></li>
            <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                <li><a href="Vue/ajoutNews.php">Insertion</a></li>
            <?php } ?>
            <li><a href="../Vue/contact.php">Contact</a></li>
            <li><a href="../index.php?action=listeComplete&page=0">Tous les articles</a></li>
        </ul>

        <br>
        <br>
        <br>
        <br>
        <form method="post" action="../index.php?action=inscription">
            <div class="login-block">
                <h1>Inscription</h1>
                <input type="text" value="" name ="pseudo" placeholder="Username" id="username" />
                <input name="mail" placeholder="Mail" id="mail" />
                <input type="password" value="" name ="mdp" placeholder="Mot de passe" id="password" />
                <button type="submit">S'incrire</button>
            </div>
        </form>
        <?php require_once("footer.php"); ?>
