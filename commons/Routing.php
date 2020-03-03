<?php
namespace Commons;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
class Routing
{
    public static function customRouting($url){


        $router = new RouteCollector();

        // $router->get('/', ['Controllers\HomeController', 'index']);
        // $router->get('', function(){
        //     echo "helo";
        // });
        $router->get('', ['Controllers\carsController', 'index']);
        $router->get('add-product', ['Controllers\carsController', 'addFormProduct']);
        $router->get('edit-product/{id:i}', ['Controllers\carsController', 'editFormProduct']);
        $router->get('remove-edit-product/{id:i}', ['Controllers\carsController', 'removeProduct']);


        $router->post('save-add-product', ['Controllers\carsController', 'addProduct']);
        $router->post('save-edit-product', ['Controllers\carsController', 'editProduct']);
        $router->post('check-product-name', ['Controllers\carsController', 'checkNameExisted']);


        $router->get('show-brands', ['Controllers\brandsController', 'index']);
        $router->get('add-brand', ['Controllers\brandsController', 'addBrands']);
        $router->get('edit-brand/{id:i}', ['Controllers\brandsController', 'editBrands']);


        $router->group(['prefix' => 'products'], function($router){

           
            // $router->get('add-product', ['Controllers\ProductController', 'addForm']);
            // $router->get('edit-product/{id:i}', ['Controllers\ProductController', 'editForm']);
            // $router->get('remove-product/{id:i}', ['Controllers\ProductController', 'remove']);
            // $router->post('save-add-product', ['Controllers\ProductController', 'saveAdd']);
            // $router->post('save-edit-product', ['Controllers\ProductController', 'saveEdit']);
            // $router->post('check-product-name', ['Controllers\ProductController', 'checkName']);
        });
        // $router->group(['prefix' => 'users'], function($router){
        //     $router->get('/', ['Controllers\UserController', 'index']);
        // });


        // $router->group(['prefix' => 'admin'], function($router){
        //     // các đường dẫn đc quy định ra trong này thì thuộc về trang quản trị
        // });


        $dispatcher = new Dispatcher($router->getData());
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
        echo $response;
    }
}