<?php $__env->startSection('title', "Thêm sản phẩm"); ?>
<?php $__env->startSection('content'); ?>
            <section class="content">
                <div class="container-fluid">

                    <style>
                        #add-product-form {
                            margin-bottom: 100px;
                        }

                        .form-group label.error {
                            color: indianred;
                        }
                    </style>


                    <form id="add-product-form" action="<?php echo e(BASE_URL . 'products/save-add-product'); ?>" method="post" enctype="multipart/form-data">
                        <h3>Thêm mới sản phẩm</h3>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">Danh mục sản phẩm</label>
                                    <select name="brand_id" class="form-control" required>
                                        <?php
                                        foreach ($data as $value) {
                                            ?>
                                            <option value="<?php echo $value["id"] ?>"><?php echo $value["brand_name"] ?></option>
                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên sản phẩm<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="model_name">
                                </div>
                                <div class="form-group">
                                    <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="">Giảm giá</label>
                                    <input type="number" class="form-control" name="sale_price">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="number" class="form-control" name="quantity">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-8 offset-2">
                                        <img id="preview-img" src="<?php echo BASE_URL ?>public/images/default-image.jpg" class="img-fluid">
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

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>       
    <script>
        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            if (file === undefined) {
                $('#preview-img').attr('src', "<?php echo e(BASE_URL . 'public/images/default-image.jpg'); ?>");
            } else {
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('#preview-img').attr('src', reader.result);
                    // console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function() {
            /**
             * name: bắt buộc nhập, tối thiểu 4 ký tự
             * price: bắt buộc nhập, giá trị nhỏ nhất = 1
             * lượt xem: không bắt buộc nhập, nếu nhập thì phải là số, và không âm
             * đánh giá: không bắt buộc nhập, nếu nhập thì phải là số, và không âm
             * ảnh đại diện: bắt buộc, phải có đuôi là định dạng ảnh (jpg, png, jpeg, gif)
             */
            $('#add-product-form').validate({
                rules:{
                    model_name: {
                        required: true,
                        minlength: 2,
                        remote: {
                            url: "<?php echo e(BASE_URL . 'products/check-product-name'); ?> ",
                            type: "post",
                            data: {
                                name: function() {
                                    return $( "input[name='model_name']" ).val();
                                }
                            }
                        }
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    sale_price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    quantity: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    image: {
                        required: true,
                        extension: "jpg|png|jpeg|gif"
                    }
                },
                messages:{
                    model_name: {
                        required: "Nhập tên sản phẩm",
                        minlength: "Tối thiểu 2 ký tự",
                        remote: "Tên sản phẩm đã tồn tại, vui lòng chọn tên khác"
                    },
                    price: {
                        required: "Nhập giá sản phẩm",
                        number: "Yêu cầu nhập số",
                        min: "Giá trị nhỏ nhất là 1"
                    },
                    sale_price: {
                        required: "Nhập giá sản phẩm",
                        number: "Yêu cầu nhập số",
                        min: "Giá trị nhỏ nhất là 1"
                    },
                    quantity: {
                        required: "Nhập giá sản phẩm",
                        number: "Yêu cầu nhập số",
                        min: "Giá trị nhỏ nhất là 1"
                    },
                    image: {
                        required: "Hãy chọn ảnh sản phẩm",
                        extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>    

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\quanglxph07563-PHP2-Ass\views/cars/add_products.blade.php ENDPATH**/ ?>