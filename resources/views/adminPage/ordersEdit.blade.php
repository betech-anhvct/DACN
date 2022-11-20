@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <a href="{{ url('/admin/order') }}">
                                <h1><button class="btn btn-primary">Danh sách danh mục</button></h1>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="col">
                    <div class="card">
                        <div class="card-title">
                            <h4>@if($order->id) Chỉnh sửa đơn hàng <b>{{ $order->id }}</b> @else <h2>Tạo mới danh mục
                                </h2>@endif </h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (isset($isSuccess) && $isSuccess)
                            <div class="alert alert-success">
                                <ul>
                                    Cập nhập thành công
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="@if($order->id)
                                {{ url('/admin/order/update',$order->id) }}
                                @else
                                {{ url('/admin/order/create') }}
                                @endif" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-6">
                                        <label>Trạng thái</label>
                                        <select type="text" class="form-control" name="id_order"
                                            value="{{ old('id_order') ?? $order->id_order }}">
                                            <option value="0">Không</option>
                                            @foreach ($orders as $order)
                                            <option value="{{ $order->id }}">{{ $order->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') ?? $order->rUsers->email }}" disabled>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Tên người nhận</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('user_name') ?? $order->user_name }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') ?? $order->address }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') ?? $order->phone }}">
                                    </div>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-default col-2">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
