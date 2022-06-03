<?php
namespace Src\Vue;
use Src\Vue\Displayer;
class PublicDisplayer extends Displayer{
    public function __construct($template,$parts=array()) {
		parent::__construct($template,$parts=array());	
    }
    public function displayPage(){
        $this->makeLoginFormPage();
    }
    public function makeLoginFormPage(){
            $array=array("Connection" => '?object=user&amp;action=makeConnectionPage');
            $menu=array_merge($this->parts['menu'],$array);
            $this->setPart('menu', $menu);
    }

}


