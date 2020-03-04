<?php
namespace Controllers;
use Models\carsModels;
use Models\brandsModels;
class carsController{
    public  function index(){   
        $data=carsModels::getAll();
        $dataDanhmuc=brandsModels::getAll();
        // $newdata=[];
        foreach ($data as $key=> $value) {
            $databrands=brandsModels::findOne($value["brand_id"]);
            $data[$key] += [ "brands" => $databrands ];
        }
        
        include_once './views/cars/index.php';
        
    }

    public  function addFormProduct(){
        $data=brandsModels::getAll();
        include_once './views/cars/add_products.php';

    }
    
    public function addProduct(){
			$data=[
                "brand_id"=>$_POST["brand_id"],
                "model_name"=>$_POST["name"],
                "image"=>img_upload($_FILES['image']),
                "price"=>$_POST["price"],
                "sale_price"=>$_POST["sale"],
                "detail"=>$_POST["detail"],
                "quantity"=>$_POST["quantity"]
			];
			
			if(carsModels::insertData($data)){
               
				header("location:".BASE_URL."?msg=Thêm sản phẩm thành công");
			}else{
				echo "thất bại";
			}
		
		
    }

    public function editFormProduct($id){
        $datacar=carsModels::findOne($id);
        $data=brandsModels::getAll();
        include_once './views/cars/edit_products.php';
    }

    public function editProduct(){
        $id = $_POST['id'];
        $datacar=carsModels::findOne($id);
        if(!$datacar){
            header("location: " . BASE_URL . "?msg=Sai thông tin mã sản phẩm");
            die;
        }
        $filename = img_upload($_FILES['image']);
        if($filename == null){
            $filename = $datacar["image"];
        }
        
        $data=[
            "brand_id"=>$_POST["brand_id"],
            "model_name"=>$_POST["name"],
            "image"=>$filename,
            "price"=>$_POST["price"],
            "sale_price"=>$_POST["sale"],
            "detail"=>$_POST["detail"],
            "quantity"=>$_POST["quantity"]
        ];
        if(carsModels::updateData($data,"id",$id)){
               
            header("location:".BASE_URL."?msg=Cập nhật sản phẩm thành công");
        }else{
            echo "thất bại";
        }
    }

    public function removeProduct($id){
        if(carsModels::destroy($id)){
            header("location:".BASE_URL."?msg=Xóa sản phẩm thành công");
        };
        
    }

    public function checkNameExisted(){
	    $name = $_POST['name'];
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $checkNameQuery = "select * from " . (new carsModels())->table . " where model_name = '$name'";
        if($id != -1){
            $checkNameQuery .= " and id != $id";
        }
        $data = carsModels::customQuery($checkNameQuery);
	    echo count($data) == 0 ? "true" : "false";
    }
    public function searchName(){
       $key = $_REQUEST["string"];
       $datasearch = carsModels::SearchLike($key);
       foreach ($datasearch as $key=> $value) {
        $databrands=brandsModels::findOne($value["brand_id"]);
        $datasearch[$key] += [ "brands" => $databrands ];
    }
    foreach ($datasearch as $value) {
      ?>
      <tr>
              <td><?php echo $value["id"] ?></td>
              <td><?php echo $value["model_name"] ?></td>
              <td>
                  <img src="<?php echo BASE_URL . $value["image"] ?>" class="img-thumbnail">
              </td>
              <td>
              <?php echo $value["brands"]["brand_name"] ?>
              </td>
              <td><?php echo $value["price"] ?>đ</td>
              <td><?php echo $value["sale_price"] ?>đ</td>
              <td><?php echo $value["quantity"] ?></td>
              <td>
                  <a href="<?php echo BASE_URL ."edit-product/".$value["id"] ?>" class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                  <a href="<?php echo BASE_URL ."remove-edit-product/".$value["id"] ?>" class="btn btn-danger btn-sm btn-remove">Xóa</a>
              </td>
          </tr>
      <?php
    }
    }

    public function searchDanhmuc(){
        $key = $_REQUEST["string"];
        $datasearch = carsModels::SearchDanhmuc($key);
        foreach ($datasearch as $key=> $value) {
         $databrands=brandsModels::findOne($value["brand_id"]);
         $datasearch[$key] += [ "brands" => $databrands ];
     }
     foreach ($datasearch as $value) {
       ?>
       <tr>
               <td><?php echo $value["id"] ?></td>
               <td><?php echo $value["model_name"] ?></td>
               <td>
                   <img src="<?php echo BASE_URL . $value["image"] ?>" class="img-thumbnail">
               </td>
               <td>
               <?php echo $value["brands"]["brand_name"] ?>
               </td>
               <td><?php echo $value["price"] ?>đ</td>
               <td><?php echo $value["sale_price"] ?>đ</td>
               <td><?php echo $value["quantity"] ?></td>
               <td>
                   <a href="<?php echo BASE_URL ."edit-product/".$value["id"] ?>" class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                   <a href="<?php echo BASE_URL ."remove-edit-product/".$value["id"] ?>" class="btn btn-danger btn-sm btn-remove">Xóa</a>
               </td>
           </tr>
       <?php
     }
     }
}
?>