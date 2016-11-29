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
});