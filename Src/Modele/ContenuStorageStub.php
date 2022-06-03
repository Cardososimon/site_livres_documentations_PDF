<?php
namespace Src\Modele;
use Src\Modele\Contenu;
class ContenuStorageStub{
     
        private $db;
        private $type;
        
	public function __construct($type) {
            $this->db=array();
            $this->type=$type;
	}
        
        public function creatContenuPdf() {
            $lectureBDD = file_get_contents('./Contenus/'.$this->type.'/bdd.json');
            $lectureBDD = json_decode($lectureBDD, true);
            for($i=0; $i<sizeof($lectureBDD[$this->type]);$i++){
                $titre=$lectureBDD[$this->type][$i]["Titre"];
                $auteur=$lectureBDD[$this->type][$i]["Auteur"];
                $chemin=$lectureBDD[$this->type][$i]["Image"];
                $resume=$lectureBDD[$this->type][$i]["Resume"];
                $contenu = new Contenu($titre,$chemin,$auteur,$resume,$this->type);
                $this->db[$i]=$contenu;
            }
        }
        public function getDb(){
            return $this->db;
        }
        
        public function getContentByName($name){
            for($i=0;$i<sizeof($this->db);$i++){
                if($this->db[$i]->getTitre()===$name){
                     return $this->db[$i];
                }
            }
            return null;
        }
        public function setMeta($file,$titre,$auteur,$resume,$date,$typeMeta){
            if($typeMeta==='PDF_XMP'){
                $this->changeMeta($file,$titre,$auteur,$resume,$date,"PDF");
                $this->changeMeta($file,$titre,$auteur,$resume,$date,"XMP-dc");
            }else{
              $this->changeMeta($file,$titre,$auteur,$resume,$date,$typeMeta);  
            }
            $name=substr ($file , 0, -4 );
            $chemin="../Images/".$this->type."/".$name.".jpeg";
            $cheminJs="Images/".$this->type."/".$name.".jpeg";
            $this->writeInBdd($auteur,$titre,$resume,$cheminJs);
            $this->creatImage($file,$chemin);
        }
        public function changeMeta($file,$titre,$auteur,$resume,$date,$typeMeta){
            if (!preg_match("/\W*Exiftool\W*/",getcwd())){
                chdir("./Exiftool");
            }
            if($typeMeta==="XMP-dc"){
                $exec=shell_exec( "exiftool XMP-dc Title='".$titre."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool XMP-dc Creator='".$auteur."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool XMP-dc Description='".$resume."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool XMP-dc Date='".$date."'../Contenus/".$this->type."/".$file);
            }
            else{
                $exec=shell_exec( "exiftool PDF Title='".$titre."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool PDF Author='".$auteur."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool PDF Subject='".$resume."'../Contenus/".$this->type."/".$file);
                $exec=shell_exec( "exiftool PDF CreateDate='".$date."'../Contenus/".$this->type."/".$file);
            }
        }
        public function getMeta($element,$chemin){
            if (!preg_match("/\W*Exiftool\W*/",getcwd())){
                chdir($chemin);
            }
            $exec=shell_exec( "exiftool -json -g1  ../Contenus/".$this->type."/".$element);
            $txt=json_decode($exec,true);
            if(key_exists("PDF", $txt[0])){
                    $resultat['PDF']['titre']=$txt[0]['PDF']['Title'];
                    $resultat['PDF']['auteur']=$txt[0]['PDF']['Author'];
                    $resultat['PDF']['resume']=$txt[0]['PDF']['Subject'];
                    $resultat['PDF']['date']=$txt[0]['PDF']['CreateDate'];
            }
            if(key_exists('XMP-dc', $txt[0])){
                    $resultat['XMP-dc']['titre']=$txt[0]['XMP-dc']['Title'];
                    $resultat['XMP-dc']['auteur']=$txt[0]['XMP-dc']['Creator'];
                    $resultat['XMP-dc']['resume']=$txt[0]['XMP-dc']['Description'];
                    $resultat['XMP-dc']['date']=$txt[0]['XMP-dc']['Date'];
            }
            return $resultat;
        }
                
        public function addElement($element,$chemin){
            if (!preg_match("/\W*Exiftool\W*/",getcwd())){
                chdir($chemin);
            }
            $exec=shell_exec( "exiftool -json -g1  ../Contenus/".$this->type."/".$element);
            $txt=json_decode($exec,true);
            $namecomplet=$txt[0]['System']['FileName'];
            $name=substr ($namecomplet , 0, -4 );
            $chemin="../Images/".$this->type."/".$name.".jpeg";
            $cheminJson="Images/".$this->type."/".$name.".jpeg";
            if(key_exists("PDF", $txt[0])&& !key_exists("XMP-dc", $txt[0])){
                $titre=$txt[0]['PDF']['Title'];
                $auteur=$txt[0]['PDF']['Author'];
                $resume=$txt[0]['PDF']['Subject'];
                $this->writeInBdd($auteur, $titre, $resume, $chemin);
                $this->creatImage($namecomplet,$chemin);
                return true;
            }
            elseif(!key_exists("PDF", $txt[0])&& key_exists("XMP-dc", $txt[0])){
                $titre=$txt[0]['XMP-dc']['Title'];
                $auteur=$txt[0]['XMP-dc']['Creator'];
                $resume=$txt[0]['XMP-dc']['Description'];
                $this->writeInBdd($auteur, $titre, $resume, $chemin);
                $this->creatImage($namecomplet,$chemin);
                return true;
            }
            else{
                if($txt[0]['XMP-dc']['Title']===$txt[0]['PDF']['Title']){$titre=$txt[0]['XMP-dc']['Title'];}
                else{ return 'Title';}
                if($txt[0]['XMP-dc']['Creator']===$txt[0]['PDF']['Author']){$auteur=$txt[0]['XMP-dc']['Creator'];}
                else {return 'Author';}
                if($txt[0]['XMP-dc']['Description']===$txt[0]['PDF']['Subject']){$resume=$txt[0]['XMP-dc']['Title'];}
                else {return 'resume';}
                if($titre!==null && $auteur!==null && $resume!=null){
                    $this->writeInBdd($auteur, $titre, $resume, $cheminJson);
                    $this->creatImage($namecomplet,$chemin);
                }
                else{
                    return false;
                }
                if($txt[0]['XMP-dc']['Date']!==$txt[0]['PDF']['CreateDate']){return 'date';}
                else{return true;}
            }
            return false;
        }
        
        public function writeInBdd($auteur,$titre,$resume,$chemin){
            $ecritureBDD = array('Titre' => $titre, 'Auteur' => $auteur, 'Image' => $chemin, 'Resume'=>$resume);
            $lectureBDD = file_get_contents('../Contenus/'.$this->type.'/bdd.json');
            $lectureBDD = json_decode($lectureBDD, true);
            array_push($lectureBDD[$this->type],$ecritureBDD);
            file_put_contents('../Contenus/'.$this->type.'/bdd.json', json_encode($lectureBDD));
            return;
        }
        
        public function creatImage($namecomplet,$chemin){
            chdir("../Convert");
            $allname='../Contenus/'.$this->type.'/'.$namecomplet;
            $exec=shell_exec( "convert ".$allname."[0] ".$chemin);
            chdir("../Exiftool");
            return;
        }
}

