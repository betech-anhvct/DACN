@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <a href="{{ url('/admin/users') }}">
                                <h1><button class="btn btn-primary">Danh sách người dùng</button></h1>
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
                            <h4>@if($user->id) Chỉnh sửa <b>{{ $user->name }}</b> @else <h2>Tạo mới người dùng</h2>@endif </h4>
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
                                <form action="@if($user->id)
                                {{ url('/admin/users/update',$user->id) }}
                                @else
                                {{ url('/admin/users/create') }}
                                @endif" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Tên</label>
                                       <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                       <input type="email" class="form-control" name="email" value="{{ $user->email }}" @if ($user->email)
                                        disabled @endif>
                                    </div>
                                    @if(!$user->id)
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                       <input type="password" name="password" class="form-control" value="">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ old('address') ?? $user->address }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <h6>Vai trò</h6>
                                        </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="role0"
                                                value="0" @if ($user->role == 0)checked @endif >
                                            <label class="form-check-label" for="role0">Người dùng</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="role1"
                                                value="1" @if ($user->role == 1)checked @endif>
                                            <label class="form-check-label" for="role1">Quản trị</label>
                                        </div>
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
