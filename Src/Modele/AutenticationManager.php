<?php
namespace Src\Modele;
use Src\Modele\Account;

    class AutenticationManager{
                
        private $db;
        private $response;
        
        public function __construct($response) {
            $this->response=$response;
            $this->db = array(
                'toto' => array(
                'id' => 12,
                'nom' => 'toto_',
                'prenom' => 'toto',
                'mdp' => 'toto',
                'statut' => 'admin'
            )
            );
        } 
                        
        public function connectUser($login,$pwd){
            if(array_key_exists($login, $this->db)){
                if($this->db[$login]['mdp']===$pwd){
                    $user= new Account($this->db[$login]['nom'], $login, $pwd,$this->db[$login]['statut'],$this->db[$login]['id']);
                    return $user;
                }
            }
            return false;
        }
        public function isUserConnected(){
            if(key_exists('user', $_SESSION)){
                return true;
            }
            return false;
        }
        public function isAdminConnected(){
            if($this->isUserConnected()){
                if($_SESSION['user']['statut']==='admin'){
                    return true;
                }
            }
            return false;
        }
        public function getUserName(){
           
                if ($this->isUserConnected()){
                    return $_SESSION['user']['nom'];
                }
                else{
                    echo "session ne contien pas d'utilisateur";
                }  
        }
        public function disconnectUser(){
            session_destroy();
        }
        
                        
    }