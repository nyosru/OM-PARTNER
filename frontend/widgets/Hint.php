<?php

namespace frontend\widgets;

class Hint extends \yii\bootstrap\Widget
{
    public $HintTypes = [
        'minsumm'   => 'Пользователь не сможет оформить товар на сумму меньше, чем указана в этом поле',
        'margin'  => 'Ваша наценка на товары в магазине',
        'discountgroups' => 'Группы пользователей, которым вы предоставляете скидку. Для каждой группы можно установить свой размер скидки',
        'info'    => 'alert-info',
        'warning' => 'awdawd',
        'include' => 'Включительно',
        'noinclude'=>'До, не включая. Например, если вы укажете 3000, то учитываться будет 2999. Само число 3000 в этот диапазон не попадет'
    ];
    public $hint;

    public function init()
    {

      ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                placement : 'right'
            });
        });
    </script>

        <!-- Кнопки с popovers -->
        <i class="fa fa-info-circle" data-toggle="popover" style="color:darkblue; margin-left:8px;" data-content="<?= $this->HintTypes[$this->hint]?>">Подсказка</i><?php
    }
}
