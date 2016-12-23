<div style="display: none;" id="modal-comment" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4>Редактировать комментарий</h4>
            </div>
            <div class="modal-body">
                <div>
                </div>
                <?php
                \yii\widgets\Pjax::begin([
                    'id'=>'comment',
                    'enablePushState' =>false
                ]);
                ?>
                <div class="comment-content-body"></div>
                <?php
                \yii\widgets\Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>