<?php $__env->startSection('title', "Tạo sản phẩm"); ?>
<?php $__env->startSection('content'); ?>
    <style>
        #add-product-form{
            margin-bottom: 100px;
        }
        .form-group label.error{
            color: indianred;
        }
    </style>


    <form id="add-product-form" action="<?php echo e(BASE_URL . 'products/save-add-product'); ?>" method="post" enctype="multipart/form-data">
        <h3>Thêm mới sản phẩm</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên sản phẩm<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="cate_id" class="form-control">
                        <?php $__currentLoopData = $cates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ca->id); ?>"><?php echo e($ca->cate_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="form-group">
                    <label for="">Lượt xem</label>
                    <input type="number" class="form-control" name="views">
                </div>
                <div class="form-group">
                    <label for="">Đánh giá</label>
                    <input type="number" class="form-control" name="star">
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea name="short_desc" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-8 offset-2">
                        <img id="preview-img" src="<?php echo e(BASE_URL . 'public/images/default-image.jpg'); ?>" class="img-fluid">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện sản phẩm<span class="text-danger">*</span></label>
                    <input type="file" onchange="encodeImageFileAsURL(this)" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="">Thông tin chi tiết</label>
                    <textarea name="detail" class="form-control" rows="9"></textarea>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Lưu</button>&nbsp;
                <a href="<?= BASE_URL ?>" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>

<?php if(isset($_GET['msg'])): ?>
    <input type="hidden" id="msg" value="<?php echo e($_GET['msg']); ?>">
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $('#preview-img').attr('src', "<?php echo e(BASE_URL . 'public/images/default-image.jpg'); ?>");
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
                        url: "<?php echo e(BASE_URL .'products/check-product-name'); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.test-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\quanglxph07563-PHP2-Ass\views/home/test.blade.php ENDPATH**/ ?>