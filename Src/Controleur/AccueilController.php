<?php
    namespace Src\Controleur;
    use Src\Controleur\AbstractController;
    use Src\Modele\ContenuStorageStub;
    Use \Src\Request;
    class AccueilController extends AbstractController{ 
   
        
	public function __construct($request,$response,$view,$autentification){
            parent::__construct($request,$response,$view,$autentification);
            $this->view->setTemplate('Template/Accueil.php');
           
    	}

   public function execute($action){
        $this->$action();
    }

    public function defaultAction(){
        return  $this->showLivres();
    }
    public function showLivres(){
        $this->makeHomePage("Livres");
    }
    public function showDocs(){
        $this->makeHomePage("Docs");
    }
    public function makeHomePage($type) {
        $contenu=$this->makedata($type);
        $this->view->setPart('contenu',$contenu);
        $this->view->setPart('titre',"Liste de ".$type);
    }
    public function makedata($type){
        $contenuStorage = new ContenuStorageStub($type);
        $contenuStorage->creatContenuPdf();
        $listeLivre = $contenuStorage->getDb();
        $contenu=array();
        foreach ($listeLivre as $livre){
            $image = "{$livre->getImage()}";
            $content=array();
            $content ['lien']= "index.php?object=".$livre->getType()."&amp;action=show&amp;titre=".$livre->getTitre();
            $content ['titre']= "« {$livre->getTitre()} », par {$livre->getAuteur()}";
            $content ['image']= "<figure>\n<img src=\"$image\" alt=\"{$livre->getAuteur()}\" />\n";
            $content ['defimg']= "<figcaption>{$livre->getAuteur()}</figcaption>\n</figure>\n";
            array_push($contenu,$content);
        }
        return $contenu;
    }
    public function propos(){
        $this->view->setTemplate('Template/Propos.php');
    }
   
   }



