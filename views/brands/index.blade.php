@extends('layouts.admin')
@section('title', "Danh sách danh mục")
@section('content')
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
           
                @foreach ($data as $value) 
               
                    <tr>
                        <td>{{$value->id}} </td>
                        <td>{{$value->brand_name}}</td>
                        <td>
                            <img src="{{BASE_URL. $value->logo}}" class="img-thumbnail">
                        </td>
                        <td>
                        {{$value->country}}
                        </td>
                        <td>
                            <a href=" {{ BASE_URL . 'brand/edit-brand/' .$value->id}} " class="btn btn-primary btn-sm ">Sửa</a>&nbsp;
                            <a href="{{ BASE_URL . 'brand/remove-edit-brand/' .$value->id}}" class="btn btn-danger btn-sm btn-remove">Xóa</a>
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
