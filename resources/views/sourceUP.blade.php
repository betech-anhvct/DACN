<!-- Js Plugins -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
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