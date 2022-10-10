<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng kí</title>
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
            <div id="errValidate"></div>
            <form action="{{ url('register') }}" method="POST" onsubmit="return(validate())" id="registerForm"
                class="login-form">
                @csrf
                <h1>Đăng kí</h1>
                <input type="email" name="email" id="email" placeholder="*Địa chỉ Email" />
                <input type="password" name="password" id="password" placeholder="*Mật khẩu" />
                <input type="password" name="password2" id="password2" placeholder="*Nhập lại mật khẩu" />
                <input type="text" name="name" id="name" placeholder="*Tên tài khoản" />
                <input type="text" name="address" id="address" placeholder="*Địa chỉ" />
                <input type="text" name="phone" id="phone" placeholder="*Số điện thoại">
                <button type="submit" form="registerForm">Tạo tài khoản</button>
                <p class="message">Đã có tài khoản? <a href="{{ url('login') }}">Đăng nhập ngay</a></p>
                <p class="message"><a href="{{ url('/') }}">Quay lại trang chủ</a></p>
            </form>
        </div>
    </div>
    <!-- partial -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function validate() {
            var retVal = true;
            $('#errValidate').html('');
            if ($('#password').val() !== $('#password2').val()) {
                $('#errValidate').html("Mật khẩu nhập lại không khớp");
                retVal = false;
            }
            if ($('#phone').val().length != 10) {
                $('#errValidate').html("Số điện thoại phải có 10 kí tự");
                retVal = false;
            }
            return retVal;
        }
    </script>
    <script src="js/script.js"></script>
</body>

</html>