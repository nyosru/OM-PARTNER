<?php

namespace frontend\models;

use frontend\widgets\Timer;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;


class InviteSPForm extends Model
{
    public $email;
    const TIMER_OUT_ONE_MIN = 60;

    public function rules()
    {
        return [
            [['email'], 'required', 'message'=>'Не указан E-mail'],
            ['email', 'email', 'message'=>'Не корректный E-mail'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }


    public function InviteSp()
    {
        $validate = new EmailValidator();

        if(($mail = mb_strtolower($this->email)) == TRUE && $validate->validate($mail)) {

            $sess = Yii::$app->session;
            /** @var \DateTime $timer_out_time */
            $timer_out_time = Yii::$app->session->get('timerOut');
            $new_time = new \DateTime();
            $str_to_time_diff = $new_time->getTimestamp() - $timer_out_time->getTimestamp();

            if($timer_out_time && $str_to_time_diff <= self::TIMER_OUT_ONE_MIN) {
                $dteDiff = $new_time->diff($timer_out_time);
                $diff_res = $dteDiff->format("%S");
                $allow_send = false;
            } else {
                $sess->setTimeout(self::TIMER_OUT_ONE_MIN);
                $sess->set('timerOut', new \DateTime());
                $allow_send = true;
            }

            if ($allow_send) {

                $boxes = explode('@', $mail)[1];
                $liter = mb_substr($mail, 0,2);
                if(!file_exists(Yii::getAlias('@frontend/runtime/invites/'.Yii::$app->params['constantapp']['APP_ID'].'/'.$boxes.'/'. $liter . '/'))){
                    mkdir(Yii::getAlias('@frontend/runtime/invites/'.Yii::$app->params['constantapp']['APP_ID'].'/'.$boxes.'/'.$liter), 0755, true);
                }
                if(Yii::$app->getUser()->identity){
                    $usertoxml =  Yii::$app->getUser()->identity->getId();
                }else{
                    $usertoxml = 'noauth';
                }
                if(($datawriter = simplexml_load_file(Yii::getAlias('@frontend/runtime/invites/'.Yii::$app->params['constantapp']['APP_ID'].'/'.$boxes.'/'. $liter . '/'.$mail))) == TRUE){
                    if($datawriter->totalinvites >= 5){
                        return $this->addError('mail', 'Превышен лимит попыток');
                    }
                    $datawriter->totalinvites = $datawriter->totalinvites + 1;
                    $newinvite = $datawriter->invites->addChild('invite');
                    $newinvite->addChild('ip',Yii::$app->request->getUserIP());
                    $newinvite->addChild('agent',Yii::$app->request->getUserAgent());
                    $newinvite->addChild('host',Yii::$app->request->getUserHost());
                    $newinvite->addChild('datetime',date('Y-m-d H:i:s'));
                    $newinvite->addChild('userid',$usertoxml);
                    $newinvite->addChild('geo','');
                    $datawriter->saveXML(Yii::getAlias('@frontend/runtime/invites/'.Yii::$app->params['constantapp']['APP_ID'].'/'.$boxes.'/'. $liter . '/'.$mail));

                }else{
                    $datawriter = simplexml_load_string(
                        '<root>'.PHP_EOL.
                        '<name>'.$mail.'</name>'.PHP_EOL.
                        '<totalinvites>1</totalinvites>'.PHP_EOL.
                        '<invites>'.PHP_EOL.
                        '<invite>'.PHP_EOL.
                        '<ip>'.Yii::$app->request->getUserIP().'</ip>'.PHP_EOL.
                        '<agent>'.Yii::$app->request->getUserAgent().'</agent>'.PHP_EOL.
                        '<host>'.Yii::$app->request->getUserHost().'</host>'.PHP_EOL.
                        '<datetime>'.date('Y-m-d H:i:s').'</datetime>'.PHP_EOL.
                        '<userid>'.$usertoxml.'</userid>'.PHP_EOL.
                        '<geo></geo>'.PHP_EOL.
                        '</invite>'.PHP_EOL.
                        '</invites>'.PHP_EOL.
                        '</root>'.PHP_EOL
                    );
                    $datawriter->saveXML(Yii::getAlias('@frontend/runtime/invites/'.Yii::$app->params['constantapp']['APP_ID'].'/'.$boxes.'/'. $liter . '/'.$mail));
                }
                $set = Yii::$app->session->set(md5(sha1(md5(Yii::$app->session->getId()))), md5(sha1(Yii::$app->session->getId())));
                return true;
            } else {
                return $this->addError('mail', 'Попробуйте позже<div>'.Timer::widget([
                        'time'=>isset($diff_res) ? self::TIMER_OUT_ONE_MIN - $diff_res : self::TIMER_OUT_ONE_MIN
                    ]).'</div>');
            }
        }else{
            return $this->addError('mail', 'Не указан E-mail');
        }




    }




}