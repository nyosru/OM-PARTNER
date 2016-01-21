var HeaderTop = $('.header-container').offset().top;
$(window).scroll(function () {
    if ($(window).scrollTop() > HeaderTop) {
        $('.header-container').addClass('smaller');
    } else {
        $('.header-container').removeClass('smaller');
    }
});