<?php
    namespace Src\Controleur;
    use Src\Controleur\AbstractController;
    use Src\Modele\ContenuStorageStub;

    class UploadController extends AbstractController{
        
	public function __construct($request,$response,$view,$autentification){
            parent::__construct($request,$response,$view,$autentification);
 
    	}

   public function execute($action){
        $this->$action();
    }

    public function defaultAction(){
        return  $this->show();
    }
    
    public function show(){
        $this->view->setTemplate('Template/UploaderTemplate.php');
        $this->view->setPart('titre','choisissez les fichiers que vous souhaitez upload');
    }
    public function send(){
        $files=$this->request->getFilefile();
        $post=$this->request->getPostParam('type');
        if($files!==null && $post!==null){
            $acc = -1;
            $j=0;
            for($i=0;$i<sizeof($files['name']);$i++){
                $filename = $files['name'][$i];
                $location = './Contenus/'.$post.'/'.$filename;
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                if($file_extension==="pdf"){
                    if(move_uploaded_file($files['tmp_name'][$i],$location)){
                        $acc+=1;
                    }
                }
                $j=$i;
           }
           if($acc===$j){
               $this->valideMeta($files,$post);
           }
           else{
            $this->response->addheader("Location: http://idc/index.php?object=upload&action=show");
            $this->response->sendheader();}
        }
    }
    public function ajaxValideMeta(){
        
    }
    public function valideMeta($files,$type){
        $meta=new ContenuStorageStub($type);
        for($i=0;$i<sizeof($files['name']);$i++){
            $tmp=$meta->getMeta($files['name'][$i], "./Exiftool");
            if(key_exists('PDF', $tmp)&& key_exists("XMP-dc", $tmp)){
                foreach($tmp['PDF'] as $cle => $value ){
                    if($tmp['PDF'][$cle]!==$tmp['XMP-dc'][$cle]){
                        $val['0']=$value;
                        $val['1']=$tmp['XMP-dc'][$cle];
                        $res[$i]['PDF_XMP'][$cle]=$val;
                    }
                    else{
                    $res[$i]['PDF_XMP'][$cle]=$value;
                    }
                }   
            }
            else{
                $res[$i]=$tmp;
            }
            $res[$i]['filename']=$files['name'][$i];
            $res[$i]['type']=$type;
        }
        $this->view->setTemplate('Template/MetaTemplate.php');
        $this->view->setPart('contenu',$res);
    }
    public function valide(){
        $post=$this->request->getAllPost();
        $acc=0;
        for($i=0;$i<sizeof($post);$i+=7){
            $titre=$post[$acc.'titre'];
            $auteur=$post[$acc.'auteur'];
            $resume=$post[$acc.'resume'];
            $date=$post[$acc.'date'];
            $file=$post[$acc.'filename'];
            $type=$post[$acc.'type'];
            $typeMeta=$post[$acc.'typeMeta'];
            $meta=new ContenuStorageStub($type,$file);
            $meta->setMeta($file,$titre,$auteur,$resume,$date,$typeMeta);
            $acc+=1;
        }
        $this->response->addheader("Location: http://idc/index.php?object=home&action=showLivres");
        $this->response->sendheader();
    }
}


  