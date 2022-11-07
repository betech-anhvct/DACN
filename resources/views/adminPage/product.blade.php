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
                                <div id="deleteMsg">
                                </div>
                            </div>
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive" id="product-table">
                                    <table id="row-select" class="display table table-borderd table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Tên</th>
                                                <th>Danh mục</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center">{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->rCategories->name }}</td>
                                                <th class="col-3" style="text-align:right;">
                                                    <a href="{{ url('/admin/product/update',$product->id) }}"><button
                                                            class="btn btn-outline-primary m-1"
                                                            name="btn-update[{{ $product->id }}]"
                                                            id="{{ $product->id }}">Chỉnh
                                                            sửa</button></a>
                                                    <button class="btn btn-outline-danger m-1"
                                                        name="btn-delete[{{ $product->id }}]"
                                                        id="{{ $product->id }}">Xóa</button>
                                                </th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Danh mục</th>
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
                url: '{{ url('/admin/products/delete') }}/' + id,
                type: 'POST',
                data: {
                    _token:"{{ csrf_token() }}",
                    id: id,
                }
            }).done(function(data) {
                window.location='{{ url('/admin/product') }}';
            });
        }    
        });
    });
</script>
@endsection