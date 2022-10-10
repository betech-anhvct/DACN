<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./css/styleLogin.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="login-page">
        <div class="form">
            @if (Session::has('login_status'))
                <h5>*&ensp;{{ session('login_status') }}</h5>
            @endif
            @foreach ($errors->all() as $key => $err)
                <h5>*&ensp;{{ $err }}</h5>
            @endforeach()
            <form action="{{ url('login') }}" method="POST" id="loginForm" class="login-form">
                @csrf
                <h1>Đăng nhập</h1>
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Mật khẩu" name="password" />
                <button type="submit" form="loginForm">Đăng nhập</button>
                <p class="message">Chưa đăng kí? <a href="{{ url('register') }}" id="register">Tạo tài khoản</a></p>
                <p class="message"><a href="{{ url('/') }}">Quay lại trang chủ</a></p>
            </form>
        </div>
    </div>
    <!-- partial -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
