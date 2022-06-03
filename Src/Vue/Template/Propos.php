<!DOCTYPE html>
<html lang="fr">
    <head>
	<title><?php echo $titre ?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="Skin/style.css">
    </head>
    <body>
        <header>
        </header>
	<nav class="menu">
            <ul>
            <?php
            foreach ($menu as $text => $link) {
                echo "<li><a href=\"$link\">$text</a></li>";
            }?>
            </ul>
	</nav>
        auteur :CARDOSO  Simon</br>
	    implémentation: </br>
        mise en place du pattern MVCR</br>
        Ce site permet de parcourir des livres ou des documents</br>
        Les informations des livres ou documents sont générées à partir des meta-données contenues dans les fichiers pdf</br>
        Il y a une création de l'image du fichier à l'aide de la librairie ImageMagick</br>
        Il y a une gestion de cohérence des meta-données lors de l'upload de fichier</br>
        Les nouvelles données sont enregistrées dans des fichiers json permettant la simulation d'une bdd</br>
        Mise en place d'un système d'accès. Dans ce projet seul l'utilisateur toto avec pour mdp toto à accés à la page upload
    </body>
</html>