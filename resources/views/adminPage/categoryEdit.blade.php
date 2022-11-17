@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <a href="{{ url('/admin/category') }}">
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
                            <h4>@if($category->id) Chỉnh sửa <b>{{ $category->name }}</b> @else <h2>Tạo mới danh mục</h2>@endif </h4>
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
                                <form action="@if($category->id)
                                {{ url('/admin/category/update',$category->id) }}
                                @else
                                {{ url('/admin/category/create') }}
                                @endif" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>
                                            <h6>Trạng thái</h6>
                                        </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if ($category->status == 1)checked @endif>
                                            <label class="form-check-label" for="status1">Hiển thị</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="2" @if ($category->status == 2)checked @endif >
                                            <label class="form-check-label" for="status2">Ẩn</label>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') ?? $category->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục cha</label>
                                        <select type="text" class="form-control" name="id_category"
                                            value="{{ old('id_category') ?? $category->id_category }}">
                                            <option value="0">Không</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-default">Lưu</button>
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
