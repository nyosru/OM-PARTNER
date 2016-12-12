$(function() {

// Dropdown toggle
    $('.dropdown-toggle').click(function(){
        $(this).next('.dropdown').toggle('fast');
    });

    $(document).click(function(e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
            $('.dropdown').hide('fast');
        }
    });

});