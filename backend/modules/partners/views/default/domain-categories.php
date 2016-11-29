<?php
use yii\widgets\ActiveForm;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2><?=$domain->domain?></h2>
</div>
<div class="modal-body clearfix">
    <?php ActiveForm::begin(['id'=>'form-checkbox']);?>
    <div id="tree-checkbox">
        <ul>
            <?php
            printTree($tree_categories,$allow_cat);

            function printTree($categories,$allow_cat){
                foreach($categories as $category) {
                    if(in_array($category["categories_id"],$allow_cat)){
                        $check = 'true';
                    } else {
                        $check = 'false';
                    }
                    echo '<li class="jstree-closed" data-jstree=\'{"selected":'.$check.'}\' data-category_id="'.$category["categories_id"].'">';
                    echo $category["partnersCatDescription"]["categories_name"];
                    if (isset($category["children"])) {
                        echo '<ul>';
                        printTree($category["children"],$allow_cat);
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>
    <?php ActiveForm::end();?>
</div>

<?php
$this->registerJs(<<<JS
    // инициализация дерева чекбоксов
    var treeCheckbox = $('#tree-checkbox');
    treeCheckbox.jstree({
        "core": {
            "themes":{
                "icons":false
            }
        },
        "checkbox" : {
            "keep_selected_style" : false
        },
        "plugins" : [ "checkbox" ]
    });

    // сворачивает активный список (по умолчанию развернут)
    treeCheckbox.on('ready.jstree', function() {
        treeCheckbox.jstree('close_all');
    });

    // событие при смене состояния чекбокса
    treeCheckbox.on("changed.jstree", function(e) {
        var checked_ids = [];
        treeCheckbox.jstree("get_checked",true).forEach(function(item){
            checked_ids.push(item.data.category_id);
        });
        var form = $('#form-checkbox');
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: {allow_cat: checked_ids.join(",")}
        }).done(function(data) {
          console.log(data);
        });
        e.preventDefault();
    });
JS
    , $this::POS_READY);
?>
