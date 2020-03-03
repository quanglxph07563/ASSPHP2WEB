<?php
namespace Controllers;
use Models\brandsModels;
class brandsController{
    public function index(){
        $data=brandsModels::getAll();
        include_once './views/brands/index.php';
    }

    public function addBrand(){
        include_once './views/brands/add_brands.php';
    }

    public function saveAddBrand(){
        $data=[
            "brand_name"=>$_POST["name"],
            "logo"=>img_upload($_FILES['image']),
            "country"=>$_POST["country"]
        ];
        
        if(brandsModels::insertData($data)){
           
            header("location:".BASE_URL."show-brands?msg=Thêm thương hiệu thành công");
        }else{
            echo "thất bại";
        }
    }

    public function editBrand($id){
        $databrand=brandsModels::findOne($id);
        include_once './views/brands/edit_brands.php';
    }

    public function saveEditBrand(){
        $id = $_POST['id'];
        $databrand=brandsModels::findOne($id);
        // dd($databrand);
        if(!$databrand){
            header("location: " . BASE_URL . "show-brands?msg=Sai thông tin mã thương hiệu");
            die;
        }
        $filename = img_upload($_FILES['image']);
        if($filename == null){
            $filename = $databrand["logo"];
        }
        
        $data=[
            "brand_name"=>$_POST["name"],
            "logo"=> $filename,
            "country"=>$_POST["country"]
        ];
        if(brandsModels::updateData($data,"id",$id)){
               
            header("location:".BASE_URL."show-brands?msg=Cập nhật thương hiệu thành công");
        }else{
            echo "thất bại";
        }
    }


    public function removeBrand($id){
        if(brandsModels::destroy($id)){
            header("location:".BASE_URL."show-brands?msg=Xóa thương hiệu thành công");
        };
        
    }


    public function checkNameBrand(){
	    $name = $_POST['name'];
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $checkNameQuery = "select * from " . (new brandsModels())->table . " where brand_name = '$name'";
        if($id != -1){
            $checkNameQuery .= " and id != $id";
        }
        $data = brandsModels::customQuery($checkNameQuery);
	    echo count($data) == 0 ? "true" : "false";
    }
}
?>