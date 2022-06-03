<?php 	
	namespace Src;
	session_start();
	use Src\Vue\{
                    PublicDisplayer,
                    PrivateDisplayer
        };
	use Src\Router;
    use Src\Modele\AutenticationManager;	
	class FronteController{

		protected $request;
		protected $response;

		public function __construct($request,$response){
                    $this->request=$request;
                    $this->response=$response;
		}

		public function main(){
                $autentification = new AutenticationManager($this->response);
                if($autentification->isUserConnected()){
                    $view=new PrivateDisplayer('Template/Basique.php');
                }
                else{
                    $view=new PublicDisplayer('Template/Basique.php');
                }
	        $router = new Router($this->request);
	        $className = $router->getNameController();
	        $action = $router->getControllerAction();
	        $controller = new $className($this->request, $this->response, $view,$autentification);
	        $controller->execute($action);
	        if ($this->request->isAjaxRequest()) {
                    //$content = $view->getPart('contenu');
	        } else {
                    $content = $view->render();
	        }
	        $this->response->send($content);
		}
	}