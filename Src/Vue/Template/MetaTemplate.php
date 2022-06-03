
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="Skin/style.css">
        <link rel="stylesheet" href="Skin/meta.css">
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
            <form method="post" action="index.php?object=upload&amp;action=valide">
                <?php 
                for($i=0;$i<sizeof($contenu);$i++){
                    echo '<p>';
                    foreach ($contenu[$i] as $cle =>$val){
                        if ($cle!=="filename" && $cle!="type"){
                            echo '<p>';
                            echo "<h3>".$contenu[$i]['filename']." données de type: ".$cle."</h3>";
                            echo '</p>';
                            foreach ($val as $cleMeta => $valMeta){
                                echo '<p>';
                                echo "<label for='".$i.$cleMeta."'>".$cleMeta.":</label>";
                                if($cleMeta!=="resume"){
                                    if(is_string($valMeta)){
                                        echo "<input type='text' id='".$i.$cleMeta."' name='".$i.$cleMeta."' required minlength='4'  value='".$valMeta."'>";
                                    }
                                    else{
                                        echo "</br>il y a une incohérance :</br><b>".$valMeta['1'].'</b>  ou bien  <b>'. $valMeta['1']."</b></br>";
                                        echo "<input type='text' id='".$i.$cleMeta."' name='".$i.$cleMeta."' required minlength='4'  value='' placeholder='copiez ou ecrivez '>";
                                    }
                                }
                                else{
                                    if(is_string($valMeta)){
                                        echo "<textarea  id='".$i.$cleMeta."' name='".$i.$cleMeta."' required rows='5' cols='120'>".$valMeta."</textarea>";
                                    }
                                    else{
                                        echo "il y a une incohérance :</br><b>".$valMeta['1']."</b></br>   ou bien   </br><b>". $valMeta['1']."</b></br>";
                                        echo "<textarea  id='".$i.$cleMeta."' name='".$i.$cleMeta."' required   rows='5' cols='33'></textarea>";
                                    }
                                }
                            echo '</p>';
                            }
                            $name=$i.'filename';
                            $type=$i.'type';
                            $typemeta=$i.'typeMeta';
                            echo "<input type='hidden' name='".$name."' value='".$contenu[$i]['filename']."'>";
                            echo "<input type='hidden' name='".$type."' value='".$contenu[$i]['type']."'>";
                            echo "<input type='hidden' name='".$typemeta."' value='".$cle."'>";
                        }
                    }
                    echo '</p>';
                }
                ?>
                <input type="submit" value="envoyer">
            </form>
	</main>
    </body>
</html>


