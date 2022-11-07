@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            {{-- <h1>Hello, <span>Welcome Here</span></h1> --}}
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Người dùng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h1>Danh sách người dùng</h1>
                                <a href="{{ url('/admin/users/create') }}"><button class="btn btn-success m-1"><i class="fa fa-plus"></i>&ensp;Thêm</button></a>
                            </div>
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive" id="user-table">
                                    <table id="row-select" class="display table table-borderd table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Địa chỉ</th>
                                                <th>Số điện thoại</th>
                                                <th>Vai trò</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if ($user->role == 0)
                                                    Khách hàng
                                                    @else
                                                    Quản trị
                                                    @endif</td>
                                                <th class="col-3" style="text-align:right;">
                                                    <a href="{{ url('/admin/users/update',$user->id) }}"><button
                                                            class="btn btn-outline-primary m-1"
                                                            name="btn-update[{{ $user->id }}]"
                                                            id="{{ $user->id }}">Chỉnh
                                                            sửa</button></a>
                                                    <button class="btn btn-outline-danger m-1"
                                                        name="btn-delete[{{ $user->id }}]"
                                                        id="{{ $user->id }}">Xóa</button>
                                                </th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Địa chỉ</th>
                                                <th>Số điện thoại</th>
                                                <th>Vai trò</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
        </div>
    </div>
</div>
<script>
    $('[name^="btn-delete"]').each(function(){
        $(this).click(function(){
        var id = $(this).attr('id');
        isDelete = window.confirm('Bạn có muốn xóa '+ id);
        if(isDelete){
            $.ajax({
                url: '{{ url('/admin/user/delete') }}/' + id,
                type: 'POST',
                data: {
                    _token:"{{ csrf_token() }}",
                    id: id,
                }
            }).done(function(data) {
                window.location='{{ url('/admin/users') }}';
            });
        }    
        });
    });
</script>
@endsection