@extends('masterAP')
@section('contentAP')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="{{ url('/admin/voucher') }}">
                                    <h1><button class="btn btn-primary">Danh sách mã giảm giá</button></h1>
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
                                <h4>
                                    @if ($voucher->id)
                                        Chỉnh sửa
                                        <b>{{ $voucher->name }}</b>
                                    @else
                                        <h2>Tạo mới mã giảm giá</h2>
                                    @endif
                                </h4>
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
                                    <form
                                        action="@if ($voucher->id) {{ url('/admin/voucher/update', $voucher->id) }}@else{{ url('/admin/voucher/create') }} @endif"
                                        method="POST" class="row">
                                        @csrf
                                        <div class="form-group col-6">
                                            <label>Tên</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') ?? $voucher->name }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>CODE</label>
                                            <input type="text" class="form-control" name="code"
                                                value="{{ old('code') ?? ($voucher->code ?? Str::random(10)) }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Số tiền giảm</label>
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ old('discount') ?? $voucher->discount }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Số lượng</label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ old('quantity') ?? ($voucher->quantity ?? '10') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Mô tả</label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ old('description') ?? $voucher->description }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Ngày bắt đầu</label>
                                            <input type="datetime-local" class="form-control" name="begin_date"
                                                value="{{ old('begin_date') ??($voucher->begin_date ??now()->setTimezone('T')->format('Y-m-dTh:m')) }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Ngày kết thúc</label>
                                            <input type="datetime-local" class="form-control" name="end_date"
                                                value="{{ old('end_date') ?? $voucher->end_date }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Điều kiện áp dụng</label>
                                            <select type="text" class="form-control" name="condition" id="condition">
                                                <option value="1" @if ((old('condition') ?? $voucher->condition) == 1) selected @endif>
                                                    Giảm theo tổng giá</option>
                                                <option value="2" @if ((old('condition') ?? $voucher->condition) == 2) selected @endif>
                                                    Giảm theo sản phẩm</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6" id="product_list">
                                            @if ((old('condition') ?? $voucher->condition) == 2)
                                                <label>Danh sách sản phẩm</label>
                                                <select type="text" class="form-control" name="product_list[]" id="addProductList">
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <label>Giá tổng đơn hàng</label>
                                                <input type="number" class="form-control" name="product_list"
                                                    value="{{ old('product_list') ?? ($voucher->product_list ?? 0) }}">
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label>
                                                <h6>Trạng thái</h6>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1"
                                                    value="1" @if ($voucher->status == 1) checked @endif>
                                                <label class="form-check-label" for="status1">Hiển thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2"
                                                    value="2" @if ($voucher->status == 2) checked @endif>
                                                <label class="form-check-label" for="status2">Ẩn</label>
                                            </div>

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

    <script>
        var vals = [{{ $voucher->product_list }}];
        $(document).on('change', '#condition', function() {
            var condition = $(this).find(':selected').val();
            $('#product_list').empty();
            if (condition == 2) {
                html = '<label>Danh sách sản phẩm</label>' +
                        '<select type="text" class="form-control" name="product_list[]" id="addProductList">' +
                            @foreach ($products as $product)
                            '<option value="{{ $product->id }}">{{ $product->name }}</option>' +
                            @endforeach
                        '</select>';
                $('#product_list').append(html);
            } else {
                html = '<label> Giá tổng đơn hàng </label>' +
                    '<input type="number" class="form-control" name="product_list"' +
                    'value="{{ old('product_list') ?? ($voucher->product_list ?? 0) }}">';
                $('#product_list').append(html);
            }

            $('#addProductList').select2({
                multiple: true,
            });
            $('#addProductList').val(vals).trigger("change");
        });

        $(document).ready(function(){
            $('#addProductList').select2({
                multiple: true,
            });
            $('#addProductList').val(vals).trigger("change");
        });
    </script>
@endsection
