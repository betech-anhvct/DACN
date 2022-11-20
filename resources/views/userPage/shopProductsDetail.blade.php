@extends('masterUP')
@section('contentUP')

<body>
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="@foreach($product->rImages as $image){{ asset('./images/'.$image->name) }}@break
                                @endforeach">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__price">{{ number_format($product->price) }} VND</div>
                        <p>{{ $product->description }}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" id="productQty" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" onclick="onAdding2Cart({{ $product->id }})" class="primary-btn">Thêm vào giỏ
                            hàng</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>tình trạng hàng</b> <span>@if ($product->status!=0)
                                    Còn hàng
                                    @else
                                    Tạm Ngừng Bán!
                                    @endif</span></li>
                            <li><b>Shipping</b> <span>Ship trong vòng 30 phút <samp> Đặt hàng ngay</samp></span></li>
                            <li><b>Loại thức ăn</b> <span>{{ $product->rCategories->name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm khác:</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                {{-- <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.9544103877597!2d106.67564341480043!3d10.737997192347624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBDw7RuZyBOZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2s!4v1638182847795!5m2!1svi!2s"
                    height="610" width="100%" style="border:0" allowfullscreen="">
                </iframe> --}}
                @foreach ($topProducts as $product )
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{ $product->name }}</a></h6>
                            <h5>{{ number_format($product->price) }} VND</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->


</body>
<script>
    function onAdding2Cart(productID) {
        @if(Auth::check())
            $.ajax({
                type: 'POST',
                url: '{{ route('them-gio-hang') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    productID: productID,
                },
                success: function(data) {
                    $("span#cartItem").html(data.data);
                    alert(data.msg);
                }
            })
        @else
            window.location = "{{ url('login') }}";
        @endif
        }
</script>
@endsection
