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
            <form action="{{url('order')}}" class="checkout-form" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="user_name" required value="{{Auth::user()->name}}" id="name">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="address" required id="street" value="{{Auth::user()->address}}"
                                class="checkout__input__add">
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
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng</h4>
                            <div>
                                <div id="voucher_message"></div>
                                <h4><input type="text" name="voucher" class="col-12" id="voucher"
                                        placeholder="Nhập mã giảm giá tại đây"></h4>
                            </div>
                            <div class="checkout__order__products">Sản Phẩm <span>Giá Sản phẩm</span></div>
                            <ul>
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($cart as $Cart)
                                <li>
                                    {{ $Cart['name'] }} x {{ $Cart['quantity'] }}
                                    <span> {{number_format($Cart['quantity']*$Cart['price'] ) }} VND
                                    </span>
                                </li>
                                @php
                                $total += ($Cart['quantity'] * $Cart['price']);
                                @endphp
                                @endforeach
                            </ul>

                            <div class="checkout__order__subtotal">Tổng tiền ước tính
                                <span>&ensp;VND</span><span>{{ number_format($total) }}</span>
                            </div>
                            <div class="checkout__order__total">
                                <li>Giảm giá<span id="discount"></span><span>&ensp;-</span></li>
                                <li>
                                    Giá sau khi khuyến mãi
                                    <span>&ensp;VND</span><span id="total_price">{{ number_format($total) }}</span>
                                </li>
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
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
<script>
    $('#voucher').on('change',function(){
            var voucher_code = $(this).val();
            var totalPrice = {{ $total }};
            $.ajax({
                url: '{{url('checkVoucher')}}',
                type: 'post',
                data: {
                        '_token':'{{csrf_token()}}',
                        voucher_code,
                        totalPrice
                },
                success: function(data) {
                    $('#voucher_message').html(data.message);
                    var newPrice = totalPrice - data.discount;
                    $('#discount').html(data.discount);
                    $('#total_price').html(newPrice.toLocaleString('en-US'));
                }
            });
        });
</script>



</body>

@endsection
