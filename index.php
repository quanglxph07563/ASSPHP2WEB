<?php
require_once './vendor/autoload.php';
require_once './commons/helpers.php';
$url = isset($_GET['url']) == true ? $_GET['url'] : "/";
use Commons\Routing;

use  Commons\testhelo\test;
use Controllers\carsController;
use Controllers\brandsController;

Routing::customRouting($url);
// test::Helo();
        

?>
