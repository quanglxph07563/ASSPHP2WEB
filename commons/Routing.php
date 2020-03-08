<?php
namespace Commons;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
class Routing
{
    public static function customRouting($url){


        $router = new RouteCollector();
        $router->get('', ['Controllers\CarsController', 'index']);
        $router->group(['prefix' => 'products'], function($router){
            $router->get('add-product', ['Controllers\CarsController', 'addFormProduct']);
            $router->get('edit-product/{id:i}', ['Controllers\CarsController', 'editFormProduct']);
            $router->get('remove-edit-product/{id:i}', ['Controllers\CarsController', 'removeProduct']);
            $router->get('demo-layout', ["Controllers\CarsController", "demoLayout"]);
    
            $router->post('save-add-product', ['Controllers\CarsController', 'addProduct']);
            $router->post('save-edit-product', ['Controllers\CarsController', 'editProduct']);
            $router->post('check-product-name', ['Controllers\CarsController', 'checkNameExisted']);
            $router->post('search-product-name', ['Controllers\CarsController', 'searchName']);
            $router->post('search-danh-muc', ['Controllers\CarsController', 'searchDanhmuc']);
        });
 

        $router->group(['prefix' => 'brand'], function($router){
            $router->get('show-brands', ['Controllers\BrandsController', 'index']);
            $router->get('add-brand', ['Controllers\BrandsController', 'addBrand']);
            $router->get('edit-brand/{id:i}', ['Controllers\BrandsController', 'editBrand']);
            $router->get('remove-edit-brand/{id:i}', ['Controllers\BrandsController', 'removeBrand']);
    
            $router->post('save-add-brand', ['Controllers\BrandsController', 'saveAddBrand']);
            $router->post('save-edit-brand', ['Controllers\BrandsController', 'saveEditBrand']);
            $router->post('check-brand-name', ['Controllers\BrandsController', 'checkNameBrand']);
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