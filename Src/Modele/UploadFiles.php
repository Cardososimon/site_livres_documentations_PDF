<?php
namespace Src\Modele;
use Src\Modele\ContenuStorageStub;
   if(isset($_FILES['fichier'])){
       if(isset($_POST['type'])){
           $acc=-1;
           for($i=0;$i<sizeof($_FILES['fichier']['name']);$i++){
                $filename = $_FILES['fichier']['name'][$i];
                $location = '../../Contenus/'.$_POST['type'].'/'.$filename;
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
                if($file_extension==="pdf"){
                    if(move_uploaded_file($_FILES['fichier']['tmp_name'][$i],$location)){
                        $acc+=1;
                        $tabe[$i]['name']=$_FILES['fichier']['name'][$i];
                        $tabe[$i]['type']=$_POST['type']; 
                    } 
                }
                $j=$i;
           }
        if($acc==$j){
            echo json_encode($tabe);
            exit;
        }
        else{
            echo 'il y eu un probleme';
            exit;
        }
       }
    exit;
   }
   require_once 'ContenuStorageStub.php';
   if(isset($_POST['nom'])&&isset($_POST['type'])){
       /**$css = new ContenuStorageStub($_POST['type']);
       $chemin="..\..\Exiftool";
       foreach ($_POST['nom'] as $element){
        $r=$css->addElement($element,$chemin);
        echo $r;      */
       }
               
   
   