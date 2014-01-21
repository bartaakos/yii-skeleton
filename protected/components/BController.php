<?php

class BController extends Controller
{

    public $layout = 'main';

    public static function sendMail($params = array())
    {
        /** @var $message YiiMailMessage */
        $message = new YiiMailMessage;

//        $cid = $message->embed(Swift_Image::fromPath('images/logo.png'));
//        $params['params'] = array_merge($params['params'], array('cid' => $cid));

        $message->view = $params['view'];
        $message->subject = $params['subject'];
        $message->addTo($params['to']);
        if (isset($params['cc'])) {
            $message->addCc($params['cc']);
        }
        $message->setBody($params['params'], 'text/html');
        $message->from = Yii::app()->params['mail_sender'];
        Yii::app()->mail->send($message);
    }
} 