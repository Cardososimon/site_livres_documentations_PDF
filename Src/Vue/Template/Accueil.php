<!DOCTYPE html>
<html lang="fr">
    <head>
	<title><?php echo $titre ?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="Skin/style.css">
        <link rel="stylesheet" href="Skin/home.css">
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
	<main>
            <h1><?php echo $titre; ?></h1>
            <div id="conteurIteams">
            <?php 
            foreach ($contenu as $iteam){ 
                echo "<div class='iteam'>";
                echo "<a href='".$iteam['lien']."'>".$iteam['titre']."</a>";
                echo $iteam['image'];
                echo $iteam['defimg'];
                echo "</div>";
            }   
            ?>
            </div>
            <div>
                <?php
                echo "<a href=\"$footer\">A propos</a>"
                ?>
            </div>
	</main>
    </body>
</html>