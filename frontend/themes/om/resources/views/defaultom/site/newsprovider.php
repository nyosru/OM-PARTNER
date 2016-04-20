<?php

echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
foreach ($newsprovider as $valuenews) {
    echo '<div class="newspr">';
  //  echo '<div class="newsimg"><img src="'.$valuenews['image'].'"/></div>';
    echo '<div><span style=" none repeat scroll 0% 0%;float: right; padding: 4px 25px; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span>';
    echo '<span style="padding: 10px 25px; margin: 0px; display: block; none repeat scroll 0% 0%; font-weight: 600">' . $valuenews->name . '</span></div>';
    echo $valuenews->post;
    echo '</div>';

}
echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';