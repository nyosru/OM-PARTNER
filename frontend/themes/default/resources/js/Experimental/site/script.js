var HeaderTop = $('.header-container').offset().top;
$(window).scroll(function () {
    if ($(window).scrollTop() > HeaderTop) {
        $('.header-container').addClass('smaller');
    } else {
        $('.header-container').removeClass('smaller');
    }
});

$(function() {
    jQuery('.usericon').click(function() {
        if($('.header-left-link').is(':visible')) {
            jQuery('.header-left-link').attr('style', 'display:none');
        }
        else{
            jQuery('.header-left-link').attr('style','display:block');
        }

    });
});