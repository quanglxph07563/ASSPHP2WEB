<?php
namespace Controllers;
class brandsController{
    public function index(){
        include_once './views/brands/index.php';
    }

    public function addBrands(){
        include_once './views/brands/add_brands.php';
    }

    public function editBrands(){
        include_once './views/brands/edit_brands.php';
    }
}
?>