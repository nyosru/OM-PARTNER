<?php
echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
foreach ($newsprovider as $valuenews) {
    echo '<div>';
    echo '<span style=" none repeat scroll 0% 0%; padding: 4px 25px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span><br/>';
    echo '<span style="padding: 10px 25px; margin: 0px; display: block; none repeat scroll 0% 0%; font-weight: 600">' . $valuenews->name . '</span>';
    echo $valuenews->post;
    echo '</div>';

}
echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';