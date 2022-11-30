@extends('masterUP')
@section('contentUP')

<body>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
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
                            <iframe
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftuananhvu02%2F&tabs=timeline&width=225&height=369&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=410989684167536"
                                width="225" height="500" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>
                        <div class="sidebar__item">
                            <h4>Danh mục</h4>
                            <ul>
                                @foreach ($categories as $cate)
                                <li><a href="{{ url('/shopProduct/category/'.$cate->id) }}"><span
                                            style="color: green">{{ $cate->name }}</span></a></li>
                                @endforeach
                            </ul>
                            <div class="d-flex">
                                <form action="{{ url('/shopProduct/search') }}" method="GET">
                                    <input type="text" name="search" class="m-1" placeholder="Nhập tên sản phẩm">
                                    <button class="btn btn-outline-success"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($topProducts as $product)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="@foreach ($product->rImages as $image){{ asset('images/'.$image->name) }}@break @endforeach">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <a href="{{ url('shopProductDetail/'.$product->id) }}">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    @if($product->stock > 0)
                                                    <a href="javascript:void(0);"
                                                        onclick="onAdding2Cart({{ $product->id }})">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                    @endif
                                                </li>
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
                                            <h5><a href="{{ url('shopProductDetail/'.$product->id) }}">{{ $product->name }}</a></h5>
                                            <div class="product__item__price">{{ number_format($product->price) }}
                                                VND<span></span></div>
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
                                {{-- <div class="filter__sort">
                                    <span>
                                        <h5>DANH SÁCH SẢN PHẨM</h5>
                                    </span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div> --}}
                            </div>
                            <div class="section-title product__discount__title">
                                <div class="filter__found">
                                    <h2><span>DANH SÁCH SẢN PHẨM</span< /h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                {{-- <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="@foreach ($product->rImages as $image){{ asset('images/'.$image->name) }}@break @endforeach">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <a href="{{ url('shopProductDetail/'.$product->id) }}">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="onAdding2Cart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ url('shopProductDetail/'.$product->id) }}">{{ $product->name }}</a></h6>
                                    <h5>{{ number_format($product->price) }} VND</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-center product__pagination">
                        {{-- <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
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
</body>
@endsection
