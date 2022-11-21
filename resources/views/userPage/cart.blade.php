@extends('masterUP')
@section('contentUP')

<body>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
            @endif
            @if($cart_list_item)
            <div class="row" id="listCartItem">
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
                                <tr id="cartItem{{ $id }}">
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-1.jpg" alt="">
                                        <a href="{{ url('shopProductDetail/'.$id) }}">
                                            <h5 style="color: green">{{ $item['name'] }}</h5>
                                        </a>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <span id="cart_item_price_{{ $id }}">{{ number_format($item['price']) }}</span>
                                        VND
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <input id="{{ $id }}" class="col-5" type="number" name="qtyItem{{ $id }}"
                                            value="{{ $item['quantity'] }}" min="0" oninput="this.value =
                                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                    </td>
                                    <td class="shoping__cart__total">
                                        <span id="cart_item_total_{{ $id }}">{{ number_format($item['quantity'] *
                                            $item['price']) }}</span> VND
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
                    <div class="shoping__cart__btns text-center">
                        <a href="{{ url('shopProduct') }}" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                    </div>
                </div>
                <div class="col-lg-12" id="cartTotal">
                    <div class="shoping__checkout">
                        <h5></h5>
                        <ul>
                            <li>Tổng cộng <span id="totalCartPrice"></span></li>
                        </ul>
                        <form action="{{ url('checkout') }}" method="post">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn">TIẾN HÀNH THANH TOÁN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-12">
                <div class="shoping__cart__btns text-center">
                    <a href="{{ url('shopProduct') }}" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <script>
        $(document).ready(function(){
            updateTotal();
        });

        $(document).on('change','[name^="qtyItem"]',function(){
            updateItemTotal($(this).prop('id'),$(this).val());
            updateTotal();
            $.ajax({
                type: 'POST',
                url: '{{ route('cap-nhat-gio-hang') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $(this).prop('id'),
                    "quantity": $(this).val(),
                },
                success: function(data) {
                    if(data.msg){
                        alert(data.msg);
                        window.location = "{{ url('cart') }}";
                    }
                }
            });
        });

        function updateItemTotal(id,value){
            priceSingle = $('#cart_item_price_'+id).html();
            priceSingle = priceSingle.replace(/,/g, '');
            $('#cart_item_total_'+id).empty();
            $('#cart_item_total_'+id).html((priceSingle * value).toLocaleString('en-US'));
        }

        function updateTotal(){
            var total = 0;
            $('[id^="cart_item_total_"]').each(function() {
                var price = $(this).html();
                price = price.replace(/,/g, '');
                total+= parseFloat(price);
            })
            $('#totalCartPrice').empty();
            $('#totalCartPrice').html(total.toLocaleString('en-US'));
        }

        function onDelete(itemID) {
            $.ajax({
                type: 'POST',
                url: '{{ route('xoa-gio-hang') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: itemID,
                },
                success: function(data) {
                    $('#cartItem'+data.delCartItem).remove();
                    $("span#cartItem").html(data.data);
                    if(data.data == 0){
                        $('#listCartItem').remove();
                        $('#cartTotal').remove();
                    }
                }
            })
        }
    </script>
</body>
@endsection
