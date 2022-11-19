<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">Tổng trị Giá: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href="{{ url('login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ url('/index') }}">Trang chủ</a></li>
            <li><a href="{{ url('shopProduct') }}">Sản phẩm</a></li>
            <li>
                @auth
                @if (Auth::user()->role != 0)
                <li class="active"><a href="{{ url('/admin') }}">Trang quản lí</a></li>
                @endif
                @endauth
                <li><a href="{{ url('contact') }}">Liên Hệ</a></li>
                </li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free ship cho đơn từ 200.000 VND</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
@if (session('message'))
    <div>{{ session('message') }}</div>
@endif
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free ship cho đơn từ 200.000 VND</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        @if (Auth::check())
                        <div class="header__top__right__language">
                            <div>{{ Auth::user()->name }}</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#"></a></li>
                                <li><a href="{{ url('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                        @else
                        <div class="header__top__right__auth">
                            <a href="{{ url('login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="d-flex justify-content-around col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/index') }}">Trang chủ</a></li>
                        @auth
                        @if (Auth::user()->role != 0)
                        <li class="active"><a href="{{ url('/admin') }}">Trang quản lí</a></li>
                        @endif
                        @endauth
                        <li><a href="{{ url('shopProduct') }}">Sản phẩm</a></li>
                        <li><a href="{{ url('contact') }}">Liên Hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-bag"></i> <span id="cartItem">
                            @if(session()->exists('cart'))
                            {{count(session('cart'))}}
                            @else
                            0
                            @endif
                        </span></a></li>
                    </ul>
                    <div class="header__cart__price">Tổng trị giá: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal" id="HeroSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Các loại thực phẩm</span>
                    </div>
                    <ul>
                        <li><a href="#">Fresh Meat</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruit & Nut Gifts</a></li>
                        <li><a href="#">Fresh Berries</a></li>
                        <li><a href="#">Ocean Foods</a></li>
                        <li><a href="#">Butter & Eggs</a></li>
                        <li><a href="#">Fastfood</a></li>
                        <li><a href="#">Fresh Onion</a></li>
                        <li><a href="#">Papayaya & Crisps</a></li>
                        <li><a href="#">Oatmeal</a></li>
                        <li><a href="#">Fresh Bananas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <input type="text" placeholder="Bạn đang tìm gì?">
                            <button type="submit" class="site-btn">Tìm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>0826601471</h5>
                            <span>Hỗ trợ 24/7 </span>
                        </div>
                    </div>
                </div>
                @if (Request::path()=='index'|| Request::path()=='/')
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>FRUIT FRESH</span>
                        <h2>Thực phẩm <br />100% Organic</h2>
                        <p>Tự do tìm kiếm và mua sắm</p>
                        <a href="{{ url('shopProduct') }}" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
