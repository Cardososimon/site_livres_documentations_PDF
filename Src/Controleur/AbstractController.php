<?php


namespace Src\Controleur;
abstract class AbstractController{
    protected $request;
    protected $response;
    protected $view;
    protected $autentification;
        
	public function __construct($request,$response,$view,$autentification){
            $this->request=$request;
            $this->response=$response;
            $this->view=$view;
            $this->autentification=$autentification;
            $menu = array(
			"Livre" => '?object=home&amp;action=showLivres',
			"Documentation" => '?object=doc&amp;action=showDocs',
			);
       		$this->view->setPart('menu', $menu);
            $footer= "?object=home&amp;action=propos";
            $this->view->setPart('footer', $footer);
    	}  
}