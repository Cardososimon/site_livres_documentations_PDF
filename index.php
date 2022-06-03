<?php
/**
* Index, appelle de la fonction principal du router
*/
require_once('Src/Vendor/Autoloader.php');
use Src\FronteController;
use Src\Vendor\{
    Request,
    Response
};
set_include_path("./Src");
$Fctrl = new FronteController(new Request($_GET,$_POST,$_FILES,$_SERVER,$_SESSION),new Response());
$Fctrl->main();