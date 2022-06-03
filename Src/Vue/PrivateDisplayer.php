<?php
namespace Src\Vue;
use Src\Vue\Displayer;

class PrivateDisplayer extends Displayer{
    public function __construct($template,$parts=array()) {
		parent::__construct($template,$parts=array());	
    }
    public function displayPage(){
        $this->makeLoginFormPage();
    }
    public function makeLoginFormPage(){
            $array=array("Upload" => '?object=upload&amp;action=show',
                         "Deconnection" => '?object=user&amp;action=deconection');
            $menu=array_merge($this->parts['menu'],$array);
            $this->setPart('menu', $menu);
    }
    
}
