<?php
namespace Controllers;
use Jenssegers\Blade\Blade;
class BaseController
{
    protected function render($viewPath, $dataArr = []){
        $blade = new Blade('views', 'storage');
        echo $blade->make($viewPath,$dataArr)->render();
    }

}
?>