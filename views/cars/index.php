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
            <table class="table table-stripped">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th width="100">Image</th>
        <th>Category</th>
        <th>Price</th>
        <th>Sales</th>
        <th>Quantity</th>
        <th>
            <a href="<?php echo BASE_URL?>add-product" class="btn btn-sm btn-success">Thêm</a>
        </th>
        </thead>
        <tbody>
      <?php
      foreach ($data as $value) {
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
      ?>
            
   
        </tbody>
    </table>


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
        $(document).ready(function(){
            if($('#msg').val().length > 0){
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: $('#msg').val(),
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            $('.btn-remove').click(function(){
                var redirectUrl = $(this).attr('href');
                Swal.fire({
                    title: 'Thông báo!',
                    text: "Bạn có chắc chắn muốn xóa sản phẩm này ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = redirectUrl;
                    }
                })
                return false;
            });
        });
    </script>
</body>
</html>