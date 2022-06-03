<?php
namespace Src\Vue;

abstract class Displayer{
        protected $parts;
	protected $template;

	public function __construct($template){
		$this->template=$template;
	}
	public function setPart($key,$content){
		$this->parts[$key]=$content;
	}
	public function getPart($key){
		if(isset($this->parts[$key])){
			return $this->parts[$key];
		}
		return null;
	}
        public function setTemplate($template){
            $this->template=$template;
        } 
	public function render(){
                $this->displayPage();
		$titre=$this->getPart('titre');
		$contenu=$this->getPart('contenu');
		$menu=$this->getPart('menu');
                $footer=$this->getPart('footer');
		ob_start();
		include($this->template);
		$data=ob_get_contents();
		ob_end_clean();

		return $data;
	}
    abstract protected function displayPage();
}