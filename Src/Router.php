<?php

namespace Src;
use \Exception;

    class Router{

	protected $namecontroller;
	protected $controlleraction;
	protected $request;

	public function __construct($request){
            $this->request=$request;
            $this->parseRequest();
	}

	public function parseRequest(){
            // permet de savoir si un nom de class est specifié dans l'url
            $package=$this->request->getGetParam('object');
            switch($package){
                case 'upload':
                    $this->namecontroller='Src\Controleur\UploadController';
                    break;
                case 'user':
                    $this->namecontroller='Src\Controleur\ConnectionController';
                    break;
                case 'Docs':
                    $this->$this->namecontroller='Src\Controleur\ContenuController';
                    break;
                case 'Livres':
                    $this->namecontroller='Src\Controleur\ContenuController';
                    break;
                case 'home':
                    $this->namecontroller='Src\Controleur\AccueilController';
                    break;
		default:
                    $this->namecontroller='Src\Controleur\AccueilController';
            }
            if(!class_exists($this->namecontroller)){
                throw new Exception("Classe {$this->namecontroller} non existante");
            }
            $this->controlleraction=$this->request->getGetParam('action','defaultAction');
	}

	public function getNameController(){
            return $this->namecontroller;
        }
	public function getControllerAction(){
            return $this->controlleraction;
	}

    }