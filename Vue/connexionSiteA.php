<!DOCTYPE html>
<html>
    <head>
        <title>Mon blog</title>
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
        <div>
            <ul id="nav">
                <li class="right">
                    <form method="GET" action="../index.php">
                        <input name="recherche" type="text" />
                        <input name="action" value="Rechercher" type="submit">
                    </form>
                </li>
                <li class="right">
                    <?php if (!isset($_SESSION['pseudoAdmin']) && !isset($_SESSION['pseudoUser'])) { ?>
                        <a class="bouton" href="./connexionSiteA.php">Connexion Admin</a>
                        <a class="bouton" href="./connexionSiteU.php">Connexion User</a>
                        <a class="bouton" href="./inscription.php">Inscription</a>
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
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../Vue/Apropos.php">A propos</a></li>
                <?php if (isset($_SESSION['pseudoAdmin'])) { ?>
                    <li><a href="./ajoutNews.php">Insertion</a></li>
                <?php } ?>
                <li><a href="../Vue/contact.php">Contact</a></li>
                <li><a href="../index.php?action=listeComplete&page=0">Tous les articles</a></li>
            </ul>
        </div>
        <br>
        <br>
        <br>
        <br>
        <form method="post" action="../index.php?action=connexionAdmin">
            <div class="login-block">
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
                <h1>Connexion</h1>
                <input type="text" name="pseudo" placeholder="Username" required="require" id="pseudo" />
                <input type="password" name="mdp" placeholder="Password" required="require" id="mdp" />
                <button>Valider</button>
            </div>
        </form>

        <?php require_once("footer.php"); ?>
