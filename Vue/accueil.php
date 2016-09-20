<?php require_once("./Vue/Header.php"); ?>

<?php
foreach ($articles as $article) {
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
        <p> Posté par <a href="#"><?php echo $article['auteur']; ?></a> le <a><?php echo $article['date']; ?></a></p>
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
                    <div class="zone_texte"><textarea name="commentaire" rows="10" cols="60"></textarea></div>
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
    <br>
    <br>
    <br>
<div id="footer">
    <p>Copyright 2015-2016 <br/>
        © All your copyright information here.</p>
</div>
</body>
</html>
