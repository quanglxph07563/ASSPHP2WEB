<?php
require_once './vendor/autoload.php';
require_once './commons/helpers.php';
require_once './commons/database.php';
$url = isset($_GET['url']) == true ? $_GET['url'] : "/";
use Commons\Routing;
use Controllers\CarsController;
use Controllers\BrandsController;

Routing::customRouting(trim($url));
        

?>
