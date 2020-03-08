<?php $__env->startSection('title', "Danh sách danh mục"); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="container-fluid">
        <table class="table table-stripped">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th width="100">Image</th>
                <th>country</th>
                <th>
                    <a href="<?php echo BASE_URL ?>brand/add-brand" class="btn btn-sm btn-success">Thêm</a>
                </th>
            </thead>
            <tbody>
           
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
               
                    <tr>
                        <td><?php echo e($value->id); ?> </td>
                        <td><?php echo e($value->brand_name); ?></td>
                        <td>
                            <img src="<?php echo e(BASE_URL. $value->logo); ?>" class="img-thumbnail">
                        </td>
                        <td>
                        <?php echo e($value->country); ?>

                        </td>
                        <td>
                            <a href=" <?php echo e(BASE_URL . 'brand/edit-brand/' .$value->id); ?> " class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                            <a href="<?php echo e(BASE_URL . 'brand/remove-edit-brand/' .$value->id); ?>" class="btn btn-danger btn-sm btn-remove">Xóa</a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\quanglxph07563-PHP2-Ass\views/brands/index.blade.php ENDPATH**/ ?>