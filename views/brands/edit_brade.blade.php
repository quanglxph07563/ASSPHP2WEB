@extends('layouts.admin')
@section('title', "Danh sách danh mục")
@section('content')
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


        <form id="add-product-form" action="{{BASE_URL . 'save-edit-brand'}}" method="post" enctype="multipart/form-data">
            <h3>Thêm mới sản phẩm</h3>
            <div class="row col-md-6 mx-auto">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tên nhãn hiệu<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$databrand->brand_name}}" name="brand_name">
                    </div>

                    <div class="form-group">
                        <label for="">Quốc gia</label>
                        <input type="text" class="form-control" value="{{$databrand->country}}" name="country">
                    </div>
                </div>
                <input type="text" name="id" hidden value="{{$databrand->id}} ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <img id="preview-img" src="{{BASE_URL . $databrand->logo}} " class="img-fluid">
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
@endsection
@section('script')
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if (file === undefined) {
            $('#preview-img').attr('src', "{{BASE_URL . 'public/images/default-image.jpg'}}");
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
            // quy định bắt lỗi (nếu vi phạm thì hiển thị lỗi)
            rules: {
                brand_name: {
                    required: true,
                    rangelength: [4, 100],
                    remote: {
                        url: "<?php echo BASE_URL . 'check-brand-name' ?>",
                        type: "post",
                        data: {
                            name: function() {
                                return $('#add-product-form :input[name="brand_name"]').val();
                            },
                            id: function() {
                                return $("input[name='id']").val();
                            }
                        }
                    }
                },
                country: {
                    required: true,
                    minlength: 1
                },
                image: {
                    extension: "jpg|png|jpeg|gif"
                }
            },
            // Text của lỗi sẽ hiển thị ra ngoài
            messages: {
                brand_name: {
                    required: "Hãy nhập tên sản phẩm",
                    rangelength: "tên sản phẩm nằm trong khoảng 4-10 ký tự",
                    remote: "Tên danh mục đã tồn tại"
                },
                country: {
                    required: "Hãy nhập tên thành phố",
                    minlength: "Tên thành phố phải lớn hơn 1 kí tự"
                },
                image: {
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                }
            }
        });
    });
</script>
@endsection