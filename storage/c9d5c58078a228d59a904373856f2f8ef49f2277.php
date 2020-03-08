<?php $__env->startSection('title', "Danh sách sản phẩm"); ?>
<?php $__env->startSection('content'); ?>
<div class="row mb-3">
    <div class="col-sm-6">
        <div class="row">
        <select class="custom-select col-sm-4 " id="inlineFormCustomSelect" onchange="selectDanhmuc()">
            <option selected value="">Danh mục</option>           
            <?php $__currentLoopData = $dataDanhmuc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                <option value="<?php echo e($value->id); ?>"><?php echo e($value->brand_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div style="margin-right: 0px" class="input-group col-sm-4">
            <input class="form-control form-control-navbar" type="text" id="search" onkeyup="mySearch()" placeholder="Search" aria-label="Search">
        </div>
        </div>
    </div>
</div>

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
                    <a href="<?php echo e(BASE_URL); ?>products/add-product" class="btn btn-sm btn-success">Thêm</a>
                </th>
            </thead>
            <tbody id="showdata">

                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td><?php echo e($value->model_name); ?></td>
                    <td>
                        <img src="<?php echo e(BASE_URL. $value->image); ?>" class="img-thumbnail">
                    </td>
                    <td>
                        <?php echo e($value->brand->brand_name); ?>

                    </td>
                    <td><?php echo e(number_format($value->price)); ?>đ</td>
                    <td><?php echo e(number_format($value->sale_price)); ?>đ</td>
                    <td><?php echo e($value->quantity); ?></td>
                    <td>
                        <a href="<?php echo e(BASE_URL .'products/edit-product/'.$value->id); ?>" class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                        <a href=" <?php echo e(BASE_URL .'products/remove-edit-product/'.$value->id); ?>" class="btn btn-danger btn-sm btn-remove">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
        </table>


    </div><!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    var mySearch = () => {
        var keyword = $("#search").val()
        $.ajax({
            url: '<?php echo BASE_URL . "products/search-product-name" ?>',
            type: 'POST',
            dataType: 'html',
            data: 'string=' + keyword
        }).done(function(ketqua) {
            $("#showdata").html(ketqua)
        });
    }

    var selectDanhmuc = () => {
        var keyword = $("#inlineFormCustomSelect").val()
        $.ajax({
            url: '<?php echo BASE_URL . "products/search-danh-muc" ?>',
            type: 'POST',
            dataType: 'html',
            data: 'string=' + keyword
        }).done(function(ketqua) {
            $("#showdata").html(ketqua)
        });
    }
</script>
<script>
    $(document).ready(function() {
        if ($('#msg').val().length > 0) {
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: $('#msg').val(),
                showConfirmButton: false,
                timer: 1500
            })
        }
        $('.btn-remove').click(function() {
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\quanglxph07563-PHP2-Ass\views/cars/index.blade.php ENDPATH**/ ?>