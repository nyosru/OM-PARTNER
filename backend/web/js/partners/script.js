$(document).on('click', '#add-user-admin-btn', function() {
    $.ajax({
        type: "GET",
        url: "/partners/default/usersforaddrequest",
        data: 'id='+this.getAttribute('data-partner'),
        dataType:"json",
        success: function(out2) {
           console.log(out2);
            $('#user-admin-add').DataTable( {
                data: out2,
                paging: true,
                ordering: true,
                LengthChange: true,
                responsive: true,
                columns: [
                    { data: 'id', title: "id" },
                    { data: 'username', title: "Логин"},
                    { data: 'userinfo', title: "ФИО", render: function(data){
                        if(data == null){
                            return 'Не указанно';
                        }else{
                            return data.lastname+' '+data.name+' '+data.secondname;
                        }
                    }}

                ]
            } );
            $('#user-admin-add').on('click', 'tr', function () {
                var id = $('td', this).eq(0).text();
                $.ajax({
                    type: "POST",
                    url: "/partners/default/usersaddadmin",
                    data: 'id='+id,
                    dataType:"json",
                    success: function(out2) {
                        location.reload();

                    }

                });

            });
        }

    });

});
$(document).ready(function(){
   $id = $('#add-user-admin-btn').attr('data-partner');
    $.ajax({
        type: "POST",
        url: "/partners/default/usersadmin",
        data: 'id='+$id,
        dataType:"json",
        success: function(out2) {
            console.log(out2);
            $('#user-admin').DataTable( {
                data: out2,
                paging: true,
                ordering: true,
                LengthChange: true,
                responsive: true,
                columns: [
                    { data: 'id', title: "id" },
                    { data: 'username', title: "Логин"},
                    { data: 'userinfo', title: "ФИО", render: function(data){
                        if(data == null){
                            return 'Не указанно';
                        }else{
                            return data.lastname+' '+data.name+' '+data.secondname;
                        }
                    }}

                ]
            } );

            $('#user-admin').on('click', 'tr', function () {

                var id = $('td', this).eq(0).text();
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "/partners/default/usersdeladmin",
                    data: 'id='+id,
                    dataType:"json",
                    success: function(out2) {
                        location.reload();

                    }

                });

            });
}

    });
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    $urlvars = getUrlVars();



    $("[name= 'tog']").click(function(){
        var $target = $(this).attr('data-toggle');

        if( $("div[toggle ="+ $target +"]").is(':visible') )
        {
            $("div[toggle ="+ $target +"]").hide();
            $(this).text('+');
        }else{
            $("div[toggle ="+ $target +"]").show();
            $(this).text('-');
        }
    });


    (function(){
        function clicker(e){
            var legendObject;
            var fieldsetObject;
            var controlCheckbox;

            var trigger = e.srcElement||e.target;
            if (!trigger.tagName || trigger.tagName.toLowerCase() != "input" || trigger.type.toLowerCase() != "checkbox") return;


            var testElement = trigger;
            while (testElement){
                if (!testElement.tagName) return;
                var tagName = testElement.tagName.toLowerCase();
                if (tagName == "legends") {
                    legendObject = testElement;
                } else if (tagName == "li" && /(^|\s)+js-box(\s|$)+/.test(testElement.className)) {
                    fieldsetObject = testElement;
                    break;
                }
                testElement = testElement.parentNode;
            };
            if (!fieldsetObject) return;
            if (legendObject){
                var controlCheckboxValue = trigger.checked;
                var inputs = fieldsetObject.getElementsByTagName("input");
                for(var i=0; i<inputs.length; i++){
                    var input = inputs[i];
                    if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox){
                        input.checked = controlCheckboxValue;
                    };
                };
            } else {

                if (legendObject = fieldsetObject.getElementsByTagName("legends")[0]){
                    var inputs = legendObject.getElementsByTagName("input");
                    for(var i=0; i<inputs.length; i++){
                        var input = inputs[i];
                        if (input.type.toLowerCase() == "checkbox"){
                            controlCheckbox = input;
                            break;
                        };
                    };
                };
                if (!controlCheckbox) return;
                var controlCheckboxValue = true;

                var inputs = fieldsetObject.getElementsByTagName("input");
                for(var i=0; i<inputs.length; i++){
                    var input = inputs[i];

                    if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox && !input.checked){
                        controlCheckboxValue = false;
                    };
                };

                controlCheckbox.checked = controlCheckboxValue;
            }
        };


        if (document.addEventListener){
            document.addEventListener('change', clicker, true);
            document.addEventListener('click', clicker, true);
        } else {
            document.attachEvent('onchange', clicker);
            document.attachEvent('onclick', clicker);
        };
    })();


    $("legends").change(function(){

        var  $addCategoriesArray = [];
        $("input[data= 'categ']:checked").each(function(){
            $addCategoriesArray.push($(this).attr('cat-toggle'));
        });
        $.ajax({
            url: "/partners/default/savecateg",
            data: 'id='+$urlvars['id']+'&categories='+$addCategoriesArray.join(','),
            cache: false
        });

    });


    (function(){
        $.post(
            "/partners/default/getpartnerscategories",
            {
                id: $urlvars['id']
            },
            onAjaxSuccess
        );
        function onAjaxSuccess(data)
        {
            $.each(data, function(){
                $("input[cat-toggle="+ this +"]").attr('checked', 'checked');
            });


        }
    })();

    $('[toggle=0]').show();
});