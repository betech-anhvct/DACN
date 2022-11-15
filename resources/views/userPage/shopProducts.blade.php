@extends('masterUP')
@section('contentUP')

<body>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Trang chủ</a>
                            <span>Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach ($categories as $cate )
                                <li><a href="#">{{ $cate->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($latedProducts as $pr )
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="@foreach ($pr->rImages as $image)./images/{{ $image->name }}@break
                                                @endforeach" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $pr->name }}</h6>
                                                <span>{{ number_format($pr->price) }} VND</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($topProducts as $product)
                                                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="@foreach ($product->rImages as $image)./images/{{ $image->name }}@break
                                            @endforeach">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="shopProductDetail/{{ $product->id}}"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                                <li ><a href="javascript:;" id="add2cart"
                                                    @if (Auth::check()) data-toggle="model" data-target="#add2cart"
                                                    @endif
                                                    ><i class="fa fa-shopping-cart"></i></a></li>
                                                    <button id="add2cart" class="btn btn-outline-info"
                                        @if (Auth::check()) data-toggle="modal"  data-target="#add2Carrt" @endif>Add
                                        To Cart</button>
                                                <div class="modal fade" id="add2Carrt" tabindex="-1" role="dialog"
                                                    aria-labelledby="add2Carrt" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div id="msg" class="col-m-5 mx-auto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="add2Carrt" tabindex="-1" role="dialog"
                                        aria-labelledby="add2Carrt" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div id="msg" class="col-m-5 mx-auto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span></span>
                                            <h5><a href="#">{{ $product->name }}</a></h5>
                                            <div class="product__item__price">{{ number_format($product->price) }} VND<span></span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Lọc sản phẩm</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product )
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="@foreach ($product->rImages as $image)./images/{{ $image->name }}@break
                                    @endforeach">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="shopProductDetail/{{ $product->id}}"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                        <form action="{{ url('add2cart') }}" method="POST" @if (Auth::check()) data-toggle="modal"  data-target="#add2Carrt" @endif>
                                            <li><a href="#" class="add2cart"><i class="fa fa-shopping-cart"></i></a></li>
                                        </form>
                                        <button id="add2cart" class="btn btn-outline-info"
                                        @if (Auth::check()) data-toggle="modal"  data-target="#add2Carrt" @endif>Add
                                        To Cart</button>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $product->name }}</a></h6>
                                    <h5>{{ $product->price }}vnd</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-center product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <script>
        $('#add2cart').click(function() {
            @if (!Auth::check())
                window.location = "login";
            @else
                id = '{{ $product->id_product }}';
                name = $('[name="name"]:checked').val();
                quantity = $('#product_quantity').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('them-gio-hang') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id,
                        name,
                        quantity
                    },
                    success: function(data) {
                        alert(1);
                        $("span#cartItem").html(data.data);
                        $('#msg').html(data.msg)
                    }
                })
            @endif
        });
    </script>



        <!-- Js Plugins -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

@endsection
