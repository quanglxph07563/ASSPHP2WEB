@extends('layouts.admin')
@section('title', "Sửa sản phẩm")
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


        <form id="add-product-form" action="{{BASE_URL}}products/save-edit-product" method="post" enctype="multipart/form-data">
            <h3>Cập nhật sản phẩm</h3>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="">Danh mục sản phẩm</label>
                        <select name="brand_id" class="form-control" required>
                            
                            @foreach($data as $value)
                                <option {{ $datacar->brand_id == $value->id ? "selected" : ""  }}  value="{{$value->id}}">{{$value->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm<span class="text-danger">*</span></label>
                        <input type="text" value="{{$datacar->model_name}}" class="form-control" name="model_name">
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="price" value="{{$datacar->price}}">
                    </div>
                    <div class="form-group">
                        <label for="">Giảm giá</label>
                        <input type="number" class="form-control" name="sale_price" value="{{$datacar->sale_price}}">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" class="form-control" name="quantity" value="{{$datacar->quantity}}">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <img id="preview-img" src="{{BASE_URL . $datacar->image }}" class="img-fluid">
                        </div>
                    </div>
                    <input type="text" hidden name="id" value="{{ $datacar->id }}">
                    <div class="form-group">
                        <label for="">Ảnh đại diện sản phẩm<span class="text-danger">*</span></label>
                        <input type="file" onchange="encodeImageFileAsURL(this)" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Thông tin chi tiết</label>
                        <textarea name="detail" class="form-control" rows="9">{{$datacar->detail}}</textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Cập nhật</button>&nbsp;
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
            rules: {
                model_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        url: "<?= BASE_URL . 'products/check-product-name' ?>",
                        type: "post",
                        data: {
                            name: function() {
                                return $("input[name='model_name']").val();
                            },
                            id: function() {
                                return $("input[name='id']").val();
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
                    extension: "jpg|png|jpeg|gif"
                }
            },
            messages: {
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
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                }
            }
        });
    });
</script>
@endsection