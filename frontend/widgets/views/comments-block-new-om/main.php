<?php
use yii\bootstrap\ActiveForm;
use common\models\PartnersUsersInfo;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>
<?php Pjax::begin([
    'id' => 'comments-pjax',
    'timeout' => 6000,
]); ?>
<div class="box-reviews1">
    <div class="form-add">
        <?php if (!Yii::$app->user->isGuest) { ?>
            <?php $form = ActiveForm::begin([
                'id' => 'comments_add',
                'action' => BASEURL . '/newcomments',
                'options'=>['data-pjax'=>1]]
            ); ?>
                <h3>Оставить отзыв</h3>
                <fieldset>
                    <div class="review1">
                        <ul>
                            <li>
                                <?=$form->field($modelform, 'post')->label('Текст комментария')->textarea(['rows' => 3,'cols'=>5]);?>
                                <?=$form->field($modelform, 'category')->label(false)->hiddenInput(['value' => $category]);?>
                                <?=$form->field($modelform, 'relate_id')->label(false)->hiddenInput(['value' => $relateID]);?>
                            </li>
                        </ul>
                        <div class="buttons-set">
                            <button class="button submit" title="Отправить" name="partners-settings-button" type="submit"><span>Отправить</span></button>
                        </div>
                    </div>
                </fieldset>
            <?php ActiveForm::end(); ?>
        <?php } else { ?>
            <h3>Вы должны быть авторизованы для добавления отзыва</h3>
        <?php } ?>
    </div>
</div>
<div class="box-reviews2">
    <?php if (empty($comments)) { ?>
        <h3>Комментарии отсутствуют</h3>
    <?php } else { ?>
        <h3><?=$nameblock?></h3>
        <div class="box visible">
            <ul>
                <?php foreach ($comments as $comment) { ?>
                    <li>
                        <div class="review">
                            <h6><?=$comment['name']?></h6>
                            <small><?=$comment['date']?></small>
                            <div class="review-txt"><?=$comment['text']?></div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: center;margin-top: 10px;">
                <div class="pager">
                    <div class="pages">
                        <?=LinkPager::widget([
                            'pagination'=> $pagination
                            ]);?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php Pjax::end(); ?>