<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css');
?>

    <div class="row" style="margin: 10px 5px;">
        <div class="col-md-6">
            <!--            <button type="button" class="btn btn-warning btn-sm" onclick="tree_rename('#default_tree')"><i-->
            <!--                        class="glyphicon glyphicon-pencil"></i> Переименовать-->
            <!--            </button>-->
        </div>
        <div class="col-md-6">

            <?php $form = ActiveForm::begin([
                'action' => '/adminsite/default/save-category-tree',
                'method'      => 'POST',
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
                'options'     => [
                    'id' => 'jstree_save_form',
                ],
            ]); ?>
            <button type="button" class="btn btn-warning btn-sm" onclick="tree_rename('#custom_tree')"><i
                        class="glyphicon glyphicon-pencil"></i> Переименовать
            </button>
            <button type="button" class="btn btn-danger btn-sm" onclick="tree_delete('#custom_tree');"><i
                        class="glyphicon glyphicon-remove"></i> Удалить
            </button>
            <input type="hidden" name="_csrf"/>
            <?= Html::hiddenInput('jstree_data', '', ['id' => 'categoryjstreefrom-jstree_data']); ?>
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="row">
        <div id="default_tree" class="col-md-6" style="padding-right: 2px;"></div>
        <div id="custom_tree" class="col-md-6" style="padding-left: 2px;"></div>
    </div>

    <script>

        $('#jstree_save_form').on('beforeValidate', function (event, messages, deferreds) {
            $('#categoryjstreefrom-jstree_data').val(JSON.stringify($('#custom_tree').jstree(true).get_json('#', {flat: false})));
        });

        function tree_rename(id) {
            var ref = $(id).jstree(true),
                sel = ref.get_selected();
            if (!sel.length) {
                return false;
            }
            sel = sel[0];
            ref.edit(sel);
        }

        function tree_delete(id) {
            var ref = $(id).jstree(true),
                sel = ref.get_selected();
            if (!sel.length) {
                return false;
            }
            ref.delete_node(sel);
        }

    </script>
<?php
$script = <<<JS
    $(document).ready(function () {
        $('#custom_tree').jstree({
            'core': {
                'animation' : 0,
                "check_callback" : function(operation, node, node_parent, node_position, more) {
                    if (operation === "move_node") {
                        return true;
                    }
                },
                'force_text' : true,
                'themes' : { 'stripes' : true },
                'data' : $custom_categories_tree
            },
            "crrm": {
                "move": {
                    "always_copy": true 
                }
            },
            rules:{
                droppable:[ "tree-drop" ],
                multiple: true,
                deletable: false,
                draggable: false
            },
            "types" : {
                "default" : { "valid_children" : ["default"] }
            },
            "plugins" : [
                "contextmenu", "dnd", "search",
                "state", "types", "wholerow", "crrm"
            ]
        }).on("copy_node.jstree", function (e, data) {
            // сохранение оригенальных значений в data
            data.node.data = $.extend(true, {}, data.original.data);
            if (data.node.children_d.length > 0) {
                var thisTree = $(this).jstree(true);
                var originalTree = $("#default_tree").jstree(true);
                
                for (var i = 0; i < data.node.children_d.length; i++) {
                    var originalChild = originalTree.get_node(data.original.children_d[i]);
                    var copiedChild = thisTree.get_node(data.node.children_d[i]);
            
                    copiedChild.data = $.extend(true, {}, originalChild.data);
                }
            }
        }).on("move_node.jstree", function (e, data) {
            // сохранение оригенальных значений в data
            console.log(data);
            // data.node.data = $.extend(true, {}, data.original.data);
            // if (data.node.children_d.length > 0) {
            //     var thisTree = $(this).jstree(true);
            //     var originalTree = $("#default_tree").jstree(true);
            //    
            //     for (var i = 0; i < data.node.children_d.length; i++) {
            //         var originalChild = originalTree.get_node(data.original.children_d[i]);
            //         var copiedChild = thisTree.get_node(data.node.children_d[i]);
            //
            //         copiedChild.data = $.extend(true, {}, originalChild.data);
            //     }
            // }
        });
             
        $('#default_tree').jstree({
            'core': {
                'animation' : 0,
                // "check_callback" : function(callback) {
                //    
                //     return callback !== "delete_node" || callback == "copy_node";
                // },
                'force_text' : true,
                'themes' : { 'stripes' : true },
                'data': $default_categories_tree
            },           
            "crrm": {
                "move": {
                    "always_copy": true 
                }
            },
            rules:{
                droppable:[ "tree-drop" ],
                multiple:true,
                deletable:"all",
                draggable:"all"
            },
            "types" : {
                "default" : { "valid_children" : ["default"] }
            },
            "plugins" : [
                "contextmenu", "crrm", "dnd", "search",
                "state", "types", "wholerow"
            ]
        });
        
    });	
JS;

$this->registerJs($script, yii\web\View::POS_END);
