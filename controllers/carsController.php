<?php
namespace Controllers;
use Models\CarsModels;
use Models\BrandsModels;
class CarsController extends BaseController{
    public  function index(){   
        $data = CarsModels::all();
        $dataDanhmuc = BrandsModels::all();
        $totalData = CarsModels::count();
        foreach ($data as $key => $value) {          
            $databrands = BrandsModels::where('id',  $value->brand_id)->first();
            $data[$key]->brand = $databrands ;
            
        }
        // include_once './views/cars/index.php';
        $this->render('cars.index', compact('data','dataDanhmuc','totalData'));
        
    }
    public function demoLayout(){
	    $this->render('home.test', ['name' => 'thienth', 'age' => 30]);
    }

    public  function addFormProduct(){
        $data=BrandsModels::all();
        $this->render('cars.add_products', compact('data'));

    }
    
    public function addProduct(){
        $model = new CarsModels();
        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['image'];
        $filename = "";
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->image = $filename;
        $model->save();
				header("location:".BASE_URL."?msg=Thêm sản phẩm thành công");
			
		
		
    }

    public function editFormProduct($id){
        $datacar=CarsModels::find($id);
        $data=BrandsModels::all();
        // include_once './views/cars/edit_products.php';
        $this->render('cars.edit_products', compact('data','datacar'));
    }

    public function editProduct(){
        $id = $_POST['id'];
        $model = CarsModels::find($id);
        
        if(!$model){
            header("location: " . BASE_URL . "?msg=Sai thông tin mã sản phẩm");
            die;
        }

        $requestData = $_POST;

        $filename = img_upload($_FILES['image']);
        if($filename != null){
            $model->image = $filename;
        }

        $model->fill($requestData);
        $msg = $model->save() == true ? "Cập nhật thông tin sản phẩm thành công!" : "Cập nhật thông tin sản phẩm thất bại!";
        header('location: ' . BASE_URL . "?msg=$msg");
        die;
    }

    public function removeProduct($id){
        if(CarsModels::destroy($id)){
            header("location:".BASE_URL."?msg=Xóa sản phẩm thành công");
        };
        
    }

    public function checkNameExisted(){
        $name = $_POST['name'];
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
	    $queryData = CarsModels::where('model_name', $name);

	    if($id != -1){
	        $queryData->where('id', '!=', $id);
        }
        $numberRecord = $queryData->count();

	    echo $numberRecord == 0 ? "true" : "false";
    }
    public function searchName(){
       $key = $_REQUEST["string"];
       $datasearch = CarsModels::where('model_name', 'like', '%' . $key . '%')->get();
       foreach ($datasearch as $key => $value) {          
        $databrands = BrandsModels::where('id',  $value->brand_id)->first();
        $datasearch[$key]->brand = $databrands ;
        
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
              <?php echo $value["brand"]["brand_name"] ?>
              </td>
              <td><?php echo number_format($value["price"]) ?>đ</td>
                <td><?php echo number_format($value["sale_price"]) ?>đ</td>
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
        if($key==""){
            $datasearch = CarsModels::all();
        }
        else{
       $datasearch = CarsModels::where('brand_id', '=', $key )->get();
        }
       foreach ($datasearch as $key => $value) {          
        $databrands = BrandsModels::where('id',  $value->brand_id)->first();
        $datasearch[$key]->brand = $databrands ;
        
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
               <?php echo $value["brand"]["brand_name"] ?>
               </td>
               <td><?php echo number_format($value["price"]) ?>đ</td>
                <td><?php echo number_format($value["sale_price"]) ?>đ</td>
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