@extends('masterUP')
@section('contentUP')

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        @if (Session::has('error_remaining'))
        <div class="alert alert-danger" style="text-align: center">{{ Session::get('error_remaining') }}</div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger" style="text-align: center">
            @foreach ($errors->all() as $err)
            {{ $err }}
            <br>
            @endforeach
        </div>
        @endif
        <div class="checkout__form">
            <h4>CHI TIẾT HÓA ĐƠN</h4>
            @if(Auth::check())
            <form action="{{url('order')}}" method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="user_name" required value="{{Auth::user()->name}}" id="name">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="address" required id="street" value="{{Auth::user()->address}}" class="checkout__input__add">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="phone" required value="{{Auth::user()->phone}}" id="phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Địa chỉ email<span>*</span></p>
                                    <input type="text" name="email" required value="{{Auth::user()->email}}" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="shoping__continue">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng</h4>
                            <h4>
                                <div class="shoping__discount">
                                    <h5>Mã giảm giá</h5>
                                    <form action="#">
                                        <input type="text" placeholder="Nhập mã ở đây">
                                        <button type="submit" class="site-btn">Sử dụng mã</button>
                                    </form>
                                </div>
                            </h4>
                            <div class="checkout__order__products">Sản Phẩm <span>Giá Sản phẩm</span></div>
                            <ul>
                                <li>Vegetable’s Package <span>
                                        @php
                                        $total = 0;
                                        @endphp
                                    </span>
                                </li>
                            </ul>
                            <div class="checkout__order__subtotal">Tổng tiền ước tính
                                <span>

                                </span></div>
                            <div class="checkout__order__total">Giá sau khi khuyến mãi <span>

                            </span></div>
                            <button type="submit" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</section>
<!-- Checkout Section End -->
        <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

@endsection
