<!DOCTYPE html>
<html prefix="og: https://ogp.me/ns#">
    <head>
        <link rel="stylesheet" href="Skin/style.css">
        <link rel="stylesheet" href="Skin/contenu.css">
	<title><?php echo $titre ?></title>
	<meta charset="UTF-8" />
        <meta property='og:title' content='<?php echo $titre; ?>' />
        <meta property='og:type' content='article' />
        <meta property='og:url' content='<?php echo $contenu['lien']; ?> ' />
        <meta property='og:image' content='<?php echo $contenu['url']; ?> '/>
    </head>
    <body>
	<nav class="menu">
            <ul>
        <?php
	foreach ($menu as $text => $link) {
		echo "<li><a href=\"$link\">$text</a></li>";
	}
        ?>
            </ul>
	</nav>
	<main>
            <h1><?php echo $contenu['titre']; ?></h1>
            <div id='contenu'>
            <div id='img'>
            <?php echo $contenu['image']; ?>
            </div>
            <div id='resume'>
            <?php echo $contenu['resume']; ?>
            </div>
            </div>
            <?php
                echo "<a href=\"$footer\">A propos</a>"
            ?>
	</main>
    </body>
</html>
