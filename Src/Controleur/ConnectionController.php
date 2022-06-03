<?php
    namespace Src\Controleur;
    use Src\Controleur\AbstractController;
    Use \Src\Request;
    class ConnectionController extends AbstractController{
                   
	public function __construct($request,$response,$view,$autentification){
            parent::__construct($request,$response,$view,$autentification);
    	}
        public function execute($action){
            $this->$action();
        }

        public function defaultAction(){
            return  $this->makeConnectionPage();
        }
        public function makeConnectionPage() {
        $this->view->setTemplate('Template/ConnectionTemplate.php');
    }
    public function deconection(){
        session_destroy();
        $this->response->addheader("Location: http://idc/index.php");
        $this->response->sendheader();
    }
    public function verification(){
        $login=$this->request->getPostParam('pseudo');
        $mp=$this->request->getPostParam('pass');
        $account=$this->autentification->connectUser($login,$mp);
        if($account!==false){
            $this->request->setSession('user',$account);
            $this->response->addheader("Location: http://idc/index.php");
        }
        else{
            $this->response->addheader("Location: http://idc/index.php?object=user&action=makeConnectionPage");
        }
        $this->response->sendheader();
    }
    }
