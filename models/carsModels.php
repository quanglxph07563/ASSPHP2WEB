<?php
namespace Models;
use Models\BaseModels;
use Illuminate\Database\Eloquent\Model;
class CarsModels extends Model{
    protected $table = "cars";
    protected $fillable = ['brand_id', 'model_name', 'price',
    'sale_price', 'detail', 'quantity'];
    public $timestamps=false;
    // public static function SearchLike($keyword){
    //     $model = new static();
    //     $sql = "select * from " . $model->table ." WHERE model_name like '%$keyword%'";
    //     $stmt = $model->connect->prepare($sql);
    //     $stmt->execute();
    //     $data = $stmt->fetchAll();
    //     return $data;
     
    // }

    // public static function SearchDanhmuc($id){
    //     $model = new static();
    //     if($id!=null){
    //         $sql = "select * from " . $model->table ." WHERE brand_id = '$id'";
    //     }else{
    //         $sql = "select * from " . $model->table;
    //     }
        
    //     $stmt = $model->connect->prepare($sql);
    //     $stmt->execute();
    //     $data = $stmt->fetchAll();
    //     return $data;
     
    // }

}

?>