<?php

session_start();
require 'services/autoload.php';

 $router = new Router();


if(isset($_GET['route']))
{
    $router->checkRoute($_GET["route"]);
    
}else{
    
        $router->checkRoute("");

}



