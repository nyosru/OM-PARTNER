$.ajax({
    url : "/users/default/userslist",
    data : 'cat=1',
    cache : false,
    async : true,
    dataType : 'json',
    success : function(data) {

        console.log(data);
        console.log(data);
        $('#users-table').DataTable( {
            scrollX:        "200px",
            scrollCollapse: true,
            data: data,
            paging: true,
            ordering: true,
            LengthChange: true,
            responsive: true,
            columns: [
                { data: 'id', title: "Id" },
                { data: 'customers_id', title: "Пользователь ОМ"  },
                { data: 'username', title: "Логин"  },
                { data: 'id_partners', title: "Партнер"  },
                { data: 'email', title: "e-mail"  },
                { data: 'telephone', title: "Телефон"  },
                { data: 'name', title: "Имя"  },
                { data: 'lastname', title: "Фамилия"  },
                { data: 'secondname', title: "Отчество"  },
                { data: 'country', title: "Страна"  },
                { data: 'state', title: "Область\Регион"  },
                { data: 'city', title: "Город"  },
                { data: 'adress', title: "Адрес"  },
                { data: 'postcode', title: "Почтовый код"  },
                { data: 'pasportser', title: "Паспорт серия"  },
                { data: 'pasportnum', title: "Паспорт номер"  },
                { data: 'pasportdate', title: "Паспорт дата выдачи"  },
                { data: 'pasportwhere', title: "Кем выдан"  },
                { data: 'created_at', title: "Дата регистрации"  },
                { data: 'updated_at', title: "Профиль обновлен"  },
                { data: 'status', title: "Статус"  },
                { data: 'role', title: "Права"  },
            ]
        } );
    }

});