<?php
namespace Controllers;
use Models\BrandsModels;
class BrandsController extends BaseController{
    public function index(){
        $data=BrandsModels::all();
        // include_once './views/brands/index.php';
        $this->render('brands.index', compact('data'));
    }

    public function addBrand(){
        $this->render('brands.add_brade');
    }

    public function saveAddBrand(){
       $model= new BrandsModels();
       $model->fill($_POST);
       $image = $_FILES['image'];
        $filename = "";
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->logo = $filename;
        $model->save();
		header("location:".BASE_URL."show-brands?msg=Thêm danh mục thành công");
    }

    public function editBrand($id){
        $databrand=BrandsModels::find($id);
        $this->render("brands.edit_brade",compact('databrand'));
    }

    public function saveEditBrand(){
        $id = $_POST['id'];
        $databrand=brandsModels::find($id);
        // dd($databrand);
        if(!$databrand){
            header("location: " . BASE_URL . "show-brands?msg=Sai thông tin mã thương hiệu");
            die;
        }
        $filename = img_upload($_FILES['image']);
        if($filename != null){
            $databrand->image = $filename;
        }

        $databrand->fill($_POST);
        $msg = $databrand->save() == true ? "Cập nhật thông tin sản phẩm thành công!" : "Cập nhật thông tin sản phẩm thất bại!";
        header('location: ' . BASE_URL . "show-brands?msg=$msg");
        die;
    }


    public function removeBrand($id){
        if(BrandsModels::destroy($id)){
            header("location:".BASE_URL."show-brands?msg=Xóa thương hiệu thành công");
        };
        
    }


    public function checkNameBrand(){
	    $name = $_POST['brand_name'];
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
	    $queryData = BrandsModels::where('brand_name',$name);
	    if($id != -1){
	        $queryData->where('id', '!=', $id);
        }
        $numberRecord = $queryData->count();

	    echo $numberRecord == 0 ? "true" : "false";
    }
}
?>