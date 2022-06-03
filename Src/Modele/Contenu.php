<?php
namespace Src\Modele;
use Src\Modele\AbstarctContenu;
/* Représente un poème. */
class Contenu {

	
	private $title;
        private $image;
        private $author;
        private $resume;
        private $type;

	public function __construct($title, $image, $author, $resume,$type) {
            $this->author=$author;
            $this->image=$image;
            $this->resume=$resume;
            $this->title=$title;
            $this->type=$type;
	}
        public function getAuteur(){
            return $this->author;
        }
        public function getImage(){
            return $this->image;
        }
        public function getResume(){
            return $this->resume;
        }
        public function getTitre(){
            return $this->title;
        }
        public function getType(){
            return $this->type;
        }
}

?>
