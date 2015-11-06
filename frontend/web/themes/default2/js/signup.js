$.ajax({
    type: "GET",
    url: "/site/countryrequest",
    data: '',
    dataType:"json",
    success: function(out) {
console.log(out);
        $inner = '';
        $.each(
            out.response.items, function(){
                $inner += '<li data-country="'+this.id+'" id="country">'+this.title+'</li>';
            });
        $('#signupform-country').after('<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">'+$inner+'</ul>');
        $('#signupform-country').attr('autocomplete', 'off');
    }
});
$(document).on('click', '#signupform-country', function() {
    $('#country-drop').show();

});

$(document).on('click', '#country', function() {
    $('#signupform-country').val($(this).text());
    $('#signupform-country').attr('data-country', this.dataset.country);
    $('#country-drop').hide();
    $.ajax({
        type: "GET",
        url: "/site/zonesrequest",
        data: 'id='+this.dataset.country,
        dataType:"json",
        success: function(out2) {

            $inner = '';
            $.each(out2.response.items, function(){
                $inner += '<li data-state="'+this.id+'" id="state">'+this.title+'</li>';
            });
            $('#state-drop').remove();
            $('#signupform-state').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">'+$inner+'</ul>');
            $('#signupform-state').attr('autocomplete', 'off');
        }
    });
});
$(document).on('click', '#signupform-state', function() {
    $('#state-drop').show();

});
$(document).on('click', '#state', function() {
    $('#signupform-state').attr('data-state', this.dataset.state);
    $('#signupform-state').val($(this).text());
    $('#state-drop').hide();

});


$(document).on('keyup', '#signupform-country', function() {
    $filtCountryArr = $(this).siblings('ul').children();
    $search = this.value;
    $.each($filtCountryArr, function(){
       if(this.textContent.toLowerCase().indexOf($search.toLowerCase())+1){
           $(this).show();
       }else{
           $(this).hide();
       }
    });
});
$(document).on('keyup', '#signupform-state', function() {
    $filtCountryArr = $(this).siblings('ul').children();
    $search = this.value;
    $.each($filtCountryArr, function(){
        if(this.textContent.toLowerCase().indexOf($search.toLowerCase())+1){
            $(this).show();
        }else{
            $(this).hide();
        }
    });
});