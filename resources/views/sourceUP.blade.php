<!-- Js Plugins -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var part = '{{ Request::path() }}';
    if (part === 'index' || part ==='/') {
        $('#HeroSection').removeClass('hero-normal');
    }

    $('.header__menu ul li a').each(function() {
        $(this).parent().removeClass('active');
        href = $(this).attr('href');
        if(href.search(part) !== -1){
            $(this).parent().addClass('active');
        }
    });
</script>
