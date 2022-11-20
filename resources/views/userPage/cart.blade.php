@extends('masterUP')
@section('contentUP')

    <body>
        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Tên Món</th>
                                        <th>Giá tiền</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng Cộng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($cart_list_item as $id => $item)
                                    <tbody>
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="img/cart/cart-1.jpg" alt="">
                                                <h5>{{ $item['name'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ $item['price'] }}.vnd
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="pro-qty">
                                                    <input id="{{ $id }}" type="text"
                                                        value="{{ $item['quantity'] }}" onchange="onChangeQuantity(this)">
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ $item['quantity'] * $item['price'] }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <div value="{{ $id }}" onclick="onDelete({{ $id }})">
                                                    <span class="icon_close"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                            <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                Upadate Cart</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="#">
                                    <input type="text" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>$454.98</span></li>
                                <li>Total <span>$454.98</span></li>
                            </ul>
                            <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shoping Cart Section End -->
        <script>
            function onChangeQuantity(obj) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cap-nhat-gio-hang') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: $(obj).prop('id'),
                        quantity: $(obj).val(),
                    },
                    success: function(data) {
                        console.log(data)
                    }
                })
            }

            function onDelete(itemID) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('xoa-gio-hang') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(data) {
                        console.log(data)
                    }
                })
            }
        </script>
    </body>
@endsection
