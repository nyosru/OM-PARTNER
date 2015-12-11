<?php

namespace frontend\widgets;

class Hint extends \yii\bootstrap\Widget
{
    public $HintTypes = [
        'template' => 'Выберите тему оформления для вашего сайта',
        'minsumm'   => 'Пользователь не сможет оформить товар на сумму меньше, чем указана в этом поле',
        'margin'  => 'Ваша наценка на товары в магазине',
        'discountgroups' => 'Группы пользователей, которым вы предоставляете скидку. Для каждой группы можно установить свой размер скидки',
        'info'    => 'alert-info',
        'warning' => 'awdawd',
        'include' => 'Включительно',
        'noinclude' => 'До, не включая. Например, если вы укажете 3000, то учитываться будет 2999. Само число 3000 в этот диапазон не попадет',
        'logo' => 'Создайте свой логотип (отображается в левой верхней части сайта',
        'slog' => 'Напишите слоган сайта',
        'newsmainpage' => 'Количество новостей, отображаемых на главной странице',
        'commentsmainpage' => 'Количество комментариев, отображаемых на глаавной странице',
        'mailruid' => 'Идентификатор счетчика Mail.ru. Только цифры, весь скрипт не надо',
        'yandexid' => 'Идентификатор счетчика Яндекс.Метрики. Только цифры, весь скрипт не надо',
        'address' => 'Введите адрес магазина',
        'phone' => 'Введите телефон магазина. Можно ввести несколько номеров через запятую',
        'fax' => 'Введите номер факса. Можно ввести несколько номеров через запятую',
        'email' => 'введите E-mail для связи',
        'yandexmap' => 'Введите идентификатор вашей яндекс карты, только цифры',
        'googlemap' => 'Введите идентификатор вашей карты на Google maps, только цифры'
    ];
    public $hint;

    public function init()
    {

        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover({
                    placement: 'right'
                });
            });
        </script>

        <!-- Кнопки с popovers -->
        <i class="fa fa-info-circle" data-toggle="popover" style="color:darkblue; margin-left:8px;" data-content="<?= $this->HintTypes[$this->hint]?>">Подсказка</i><?php
    }
}
