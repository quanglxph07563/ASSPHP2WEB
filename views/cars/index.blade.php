@extends('layouts.admin')
@section('title', "Danh sách sản phẩm")
@section('content')
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tổng sản phẩm</span>
              <span class="info-box-number">{{ $totalData }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
</div>
<div class="row mb-3">
    <div class="col-sm-6">
        <div class="row">
        <select class="custom-select col-sm-4 " id="inlineFormCustomSelect" onchange="selectDanhmuc()">
            <option selected value="">Tất cả</option>
            
            @foreach ($dataDanhmuc as $value)    
                <option value="{{ $value->id}}">{{$value->brand_name}}</option>
            @endforeach
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
                    <a href="{{BASE_URL}}add-product" class="btn btn-sm btn-success">Thêm</a>
                </th>
            </thead>
            <tbody id="showdata">

                @foreach($data as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->model_name }}</td>
                    <td>
                        <img src="{{BASE_URL. $value->image }}" class="img-thumbnail">
                    </td>
                    <td>
                        {{ $value->brand->brand_name }}
                    </td>
                    <td>{{ $value->price }}đ</td>
                    <td>{{ $value->sale_price }}đ</td>
                    <td>{{ $value->quantity }}</td>
                    <td>
                        <a href="{{ BASE_URL .'edit-product/'.$value->id }}" class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                        <a href=" {{ BASE_URL .'remove-edit-product/'.$value->id }}" class="btn btn-danger btn-sm btn-remove">Xóa</a>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>


    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<script>
    var mySearch = () => {
        var keyword = $("#search").val()
        $.ajax({
            url: '<?php echo BASE_URL . "search-product-name" ?>',
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
            url: '<?php echo BASE_URL . "search-danh-muc" ?>',
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
@endsection