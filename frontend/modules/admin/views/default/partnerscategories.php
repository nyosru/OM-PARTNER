<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use yii\bootstrap\Modal;

$this->title = 'Категории';

function view_cat($arr, $parent_id = 0, $catnamearr)
{
    if (empty($arr[$parent_id])) {
    } else {
        if ($parent_id !== 0) {
            echo '<button type="button" name="tog" class="btn-xs btn-info btn" data-toggle="' . $parent_id . '" id="group" >+</button><div  id="categoriesdiv" toggle="' . $parent_id . '" style="display:none;"><ul id = "categories" class="dropdown">';

        } else {
            echo '<div><ul>';
        }
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            $catdesc = $arr[$parent_id][$i]['categories_id'];
            if (!$arr[$parent_id][$i] == '') {
                echo '<li id="categoriessub" class="js-box"><legends><label><input type="checkbox" data="categ" value="' . $arr[$parent_id][$i]['categories_id'] . '" name="categories_id[]" cat-toggle="' . $arr[$parent_id][$i]['categories_id'] . '"/></label></legends><a style="color: black;" href="#">'
                    . $catnamearr["$catdesc"] . '</a>';


                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr);


                echo '</li>';
            }
        }
        echo '</ul></div>';

    }
}

?>

<form action="partnerscategories" method="post">
    <?php

    view_cat($arr_cat, 0, $catnamearr); ?>
    <div>
        <input type="hidden" name="_csrf"/>
        <input type="submit" name="categories" value="Сохранить изменения"/>
    </div>
</form>
<script type="text/javascript">

    $(document).ready(function () {
        $("[name= 'tog']").click(function () {
            var $target = $(this).attr('data-toggle');

            if ($("div[toggle =" + $target + "]").is(':visible')) {
                $("div[toggle =" + $target + "]").hide();
                $(this).text('+');
            } else {
                $("div[toggle =" + $target + "]").show();
                $(this).text('-');
            }
        });
        (function () {
            function clicker(e) {
                var legendObject;
                var fieldsetObject;
                var controlCheckbox;

                var trigger = e.srcElement || e.target;
                if (!trigger.tagName || trigger.tagName.toLowerCase() != "input" || trigger.type.toLowerCase() != "checkbox") return;


                var testElement = trigger;
                while (testElement) {
                    if (!testElement.tagName) return;
                    var tagName = testElement.tagName.toLowerCase();
                    if (tagName == "legends") {
                        legendObject = testElement;
                    } else if (tagName == "li" && /(^|\s)+js-box(\s|$)+/.test(testElement.className)) {
                        fieldsetObject = testElement;
                        break;
                    }
                    testElement = testElement.parentNode;
                }
                ;
                if (!fieldsetObject) return;
                if (legendObject) {
                    var controlCheckboxValue = trigger.checked;
                    var inputs = fieldsetObject.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        var input = inputs[i];
                        if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox) {
                            input.checked = controlCheckboxValue;
                        }
                        ;
                    }
                    ;
                } else {

                    if (legendObject = fieldsetObject.getElementsByTagName("legends")[0]) {
                        var inputs = legendObject.getElementsByTagName("input");
                        for (var i = 0; i < inputs.length; i++) {
                            var input = inputs[i];
                            if (input.type.toLowerCase() == "checkbox") {
                                controlCheckbox = input;
                                break;
                            }
                            ;
                        }
                        ;
                    }
                    ;
                    if (!controlCheckbox) return;
                    var controlCheckboxValue = true;

                    var inputs = fieldsetObject.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        var input = inputs[i];

                        if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox && !input.checked) {
                            controlCheckboxValue = false;
                        }
                        ;
                    }
                    ;

                    controlCheckbox.checked = controlCheckboxValue;
                }
            };


            if (document.addEventListener) {
                document.addEventListener('change', clicker, true);
                document.addEventListener('click', clicker, true);
            } else {
                document.attachEvent('onchange', clicker);
                document.attachEvent('onclick', clicker);
            }
            ;
        })();
        $("legends").change(function () {
            var $addCategoriesArray = [];
            //   $data = $(this).getAttribute('data-categ');
            // console.log(this.childNodes);


        });
    });

</script>
