<?php
    namespace Src\Controleur;
    use Src\Controleur\AbstractController;
    use Src\Modele\ContenuStorageStub;
    Use \Src\Request;
    class ContenuController extends AbstractController{
       
        private $type;
        private $name;
                
	public function __construct($request,$response,$view,$autentification){
            parent::__construct($request,$response,$view,$autentification);
            $this->name=$this->request->getGetParam('titre');
            $this->type=$this->request->getGetParam('object');
    	}
        public function execute($action){
            $this->$action();
        }

        public function defaultAction(){
            return  $this->show();
        }
        public function show(){
            $listecontenu = new ContenuStorageStub($this->type);
            $listecontenu->creatContenuPdf();
            $contenu=$listecontenu->getContentByName($this->name);       
            $image = "{$contenu->getImage()}";
            $content=array();
            $content['titre']= "« {$contenu->getTitre()} », par {$contenu->getAuteur()}";
            $content['image']= "<figure>\n<img src=\"$image\" alt=\"{$contenu->getAuteur()}\" />\n";
            $content['defimg']= "<figcaption>{$contenu->getAuteur()}</figcaption>\n</figure>\n";
            $content['resume']= $contenu->getResume();
            $content['url']= $contenu->getImage();
            $content['lien']= "index.php?object=".$contenu->getType()."&amp;action=show&amp;titre=".$contenu->getTitre();
            $titre=$contenu->getTitre();
            $this->view->setPart('contenu',$content);
            $this->view->setPart('titre',$titre);
        }
    }
