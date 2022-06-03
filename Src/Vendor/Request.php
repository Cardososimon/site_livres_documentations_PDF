<?php
	namespace Src\Vendor;
	class Request{
		
		private $get;
		private $post;
		private $files;
		private $server;
		private $session;

		public function __construct($get,$post,$files,$server,$session){
				$this->get=$get;
				$this->post=$post;
				$this->files=$files;
				$this->server=$server;
				$this->session=$session;
		}
		public function isAjaxRequest(){
			return (!empty($this->server['HTTP_X_REQUESTED_WITH'])&&strtolower($this->server['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest');
		}
        public function getAllGet(){
            return $this->get;
        }
		public function getGetParam($key,$default=null){
			if(!isset($this->get[$key])){
				return $default;
			}
			return $this->get[$key];
		}
		public function getPostParam($key,$default=null){
			if(!isset($this->post[$key])){
				return $default;
			}
			return $this->post[$key];
		}
		public function getAllPost(){
                    return $this->post;
		}
		public function getSession($user){
			return $this->session[$user];
		}
		public function getSessionInfo($user,$info){
			return $this->session[$user][$info];
		}
        public function getServer($key){
            return $_SERVER[$key];
        }
        public function setSession($key,$value){
             $_SESSION[$key]=$value;
        }
        public function getFile(){
            if(isset($this->files['fichier'])){
                return $this->files['fichier'];
            }
        	return null;
        }
        public function getFilefile(){
            if(isset($this->files['files'])){
                return $this->files['files'];
            }
            return null;
        }
        public function getAllFiles(){
            if(isset($this->files)){
                return $this->files;
            }
            return null;
        }
        public function getFileInfo($key,$value){
            return $this->files['fichier'][$key][$value];
        }
        public function getFilefileInfo($key){
            return $this->files['files'][$key];
        }
	}