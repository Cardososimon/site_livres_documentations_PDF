<?php
spl_autoload_register(function($className){
    require_once dirname(dirname(__DIR__)).'/' .str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
});