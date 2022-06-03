<!DOCTYPE html>
<html lang=fr>
<head>
  <link rel="stylesheet" href="Skin/style.css">
  <link rel="stylesheet" href="Skin/upload.css">
  <meta charset="UTF-8" />
  <title>upload</title>
</head>
<body>
    <nav class="menu">
            <ul>
            <?php
            foreach ($menu as $text => $link) {
                echo "<li><a href=\"$link\">$text</a></li>";
            }?>
            </ul>
	</nav>
    <h3> <?php echo $titre; ?> </h3>
    <form method='post' enctype='multipart/form-data' action='index.php?object=upload&amp;action=send'>
        <input type = 'file' name = 'files[]' id = 'files' multiple>
        <p>Selectionner le type de fichier:</p>
        <input type='radio' id='Livre' name='type' value='Livres' required>
        <label for='Livre'>Livre</label>
        <input type='radio' id='Doc' name='type' value='Docs' required>
        <label for='Doc'>Doc</label>
        </br>
        <input type='submit' id='btsend'>
    </form>
  <!--  <progress id='progress-bar'></progress> -->
  <!-- <?php //require 'Scripte\uploadJS.php'; ?> -->

</body>
</html>

