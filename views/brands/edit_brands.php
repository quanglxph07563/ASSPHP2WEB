<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FPT Poly | </title>
   <?php include './views/layouts/admin/style.php' ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <!-- @include('layouts.admin.header') -->
    <?php include './views/layouts/admin/header.php' ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- @include('layouts.admin.sidebar') -->
    <?php include './views/layouts/admin/sidebar.php' ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
 
            <style>
        #add-product-form{
            margin-bottom: 100px;
        }
        .form-group label.error{
            color: indianred;
        }
    </style>


    <form id="add-product-form" action="{{BASE_URL . 'products/save-add-product'}}" method="post" enctype="multipart/form-data">
        <h3>Thêm mới sản phẩm</h3>
        <div class="row col-md-6 mx-auto">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Tên nhãn hiệu<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                </div>
               
                <div class="form-group">
                    <label for="">Thành Phố</label>
                    <input type="text" class="form-control" name="country">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-8 offset-2">
                        <img id="preview-img" src="<?php echo BASE_URL?>public/images/default-image.jpg" class="img-fluid">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện sản phẩm<span class="text-danger">*</span></label>
                    <input type="file" onchange="encodeImageFileAsURL(this)" class="form-control" name="image">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                <a href="<?= BASE_URL ?>" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.2
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- @include('layouts.admin.script') -->
<?php include './views/layouts/admin/script.php' ?>
<!-- @yield('script') -->
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $('#preview-img').attr('src', "{{BASE_URL . 'public/images/default-image.jpg'}}");
        }else{
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#preview-img').attr('src', reader.result);
                // console.log('RESULT', reader.result)
            }
            reader.readAsDataURL(file);
        }
    }
    $(document).ready(function(){
        /**
         * name: bắt buộc nhập, tối thiểu 4 ký tự
         * price: bắt buộc nhập, giá trị nhỏ nhất = 1
         * lượt xem: không bắt buộc nhập, nếu nhập thì phải là số, và không âm
         * đánh giá: không bắt buộc nhập, nếu nhập thì phải là số, và không âm
         * ảnh đại diện: bắt buộc, phải có đuôi là định dạng ảnh (jpg, png, jpeg, gif)
         */
        $('#add-product-form').validate({
            // quy định bắt lỗi (nếu vi phạm thì hiển thị lỗi)
            rules:{
                name:{
                    required: true,
                    rangelength: [4, 100],
                    remote: {
                        url: "{{BASE_URL .'products/check-product-name'}}",
                        type: "post",
                        data: {
                            name: function()
                            {
                                return $('#add-product-form :input[name="name"]').val();
                            }
                        }
                    }
                }
            },
            // Text của lỗi sẽ hiển thị ra ngoài
            messages: {
                name:{
                    required: "Hãy nhập tên sản phẩm",
                    rangelength: "tên sản phẩm nằm trong khoảng 4-10 ký tự",
                    remote: "Tên sản phẩm đã tồn tại"
                }
            }
        });
    });
</script>
</body>
</html>