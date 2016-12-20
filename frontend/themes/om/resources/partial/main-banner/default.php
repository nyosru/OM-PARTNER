<?php
use yii\bootstrap\Carousel;
use frontend\widgets\UtmLinker;

?>
<div id="main-index">
    <?php
    foreach ($template as $key=>$value){
        echo '<div id="'.$value['id'].'"  '.$value['style'].'  data-position="'.$key.'">';
        $result = '';
        $item = [];
        foreach ($position[$value['position']] as $key=>$value){
            $refer = '';
            $out_param = '';
            if($value['out']){
                $out_param = ' target="_blank" ';
                $refer = $value['referal'];
            }else{
                $refer = BASEURL.$value['referal'];
            }
            $utm_link = '';
            if($utm_enable === TRUE){
                $utm['term'] = $value['term'];
                $utm['content'] = $value['image'];
                $utm_link = UtmLinker::widget([
                    'param' => $utm
                ]);
                $divider = '?';
                if(mb_substr_count($refer, '?')){
                    $divider = '&amp;';
                }
            }

            $item[] = '<a href="'.$refer. $divider.$utm_link.'" '.$out_param.'>'.
                '<img style="display: block;max-width: 100%;height: auto;" src="'.$IMAGE_PATH.$value['image'].'"  alt="'.$value['alttext'].'">'.
                '</a>';
        }
        switch($value['roll']){
            case $ROTATE_ROLL :{
                $result =  Carousel::widget([
                    'items' => $item,
                    'showIndicators' => FALSE,
                    'controls' => FALSE,
                    'options'=>[
                        'class'=>'slide',
                        'data-ride' => 'carousel',
                    ],
                    'clientOptions'=>[
                        'interval'=>3000,
                        'pause'=> 'load',

                    ]
                ]);
                break;
            }
            case $ROTATE_RAND:{
                $rf = shuffle($item);
                $result =  array_shift($item);
                break;
            }
            default:{
            $result =   array_shift($item);
            break;
            }
        }
        echo $result;
        echo '</div>';
    }
    ?>
</div>