<?php
namespace Src\Modele;
class Account{
    private $nom;
    private $login;
    private $pass;
    private $statut;
    private $id;
   public function __construct($nom,$login,$pass,$statut,$id){
       $this->nom=$nom;
       $this->login=$login;
       $this->pass=$pass;
       $this->statut=$statut;
       $this->id=$id;
   }
   public function getNom(){
       return $this->nom;
   }
   public function getLogin(){
       return $this->login;
   }
   public function getStatut(){
       $this->login;
   }
   
}
