<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="Skin/style.css">
        <link rel="stylesheet" href="Skin/connection.css">
	<title><?php echo $titre ?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="" />
    </head>
    <body>
        <header>
            <?php //echo $header; ?>
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
            <h1>Connection:</h1>
            <form method='post' action='index.php?object=user&amp;action=verification'>
            <label for='pseudoco'>Pseudo :</label><br/>
            <input type='text' name='pseudo' id='pseudoco' placeholder='Username'/><br/>
            <label for='mdpco'>Mot de passe :</label><br/>
            <input type='password' name='pass' id='mdpco' placeholder='Password'/>
            <br/>
            <input type='submit' name='formconnexion' value='Se connecter !' /><br/>
	</main>
    </body>
</html>
