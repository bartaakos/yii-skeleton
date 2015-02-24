<?php

class Mailer
{
    public static function sendMail($params = array())
    {
        /** @var $message YiiMailMessage */
        $message = new YiiMailMessage;
        /*
        $base_path = Yii::getPathOfAlias('application.views.mail.images');
        $files = CFileHelper::findFiles($base_path);
        $imgs = array();
        foreach ($files as $file) {
            $imgs[basename($file)] = $message->embed(Swift_Image::fromPath($file));
        }
        if(isset($params['params']['attachedFilePath'], $params['params']['attachedFileName'])) {
            $message->attach(Swift_Attachment::fromPath($params['params']['attachedFilePath'])->setFilename($params['params']['attachedFileName']));
        }
        $params['params']['imgs'] = $imgs;
        */
        
        $message->view = $params['view'];
        $message->subject = $params['subject'];
        $message->setTo($params['to']);
        if (isset($params['cc'])) {
            $message->setCc($params['cc']);
        }
        if (isset($params['bcc'])) {
            $message->setBcc($params['bcc']);
        }
        $message->setBody($params['params'], 'text/html');
        $message->addPart(
            self::getPlainTextVersion($message, $params['params']),
            'text/plain'
        );
        $message->attachSigner(self::getSigner());
        $message->from = Yii::app()->params['mail_sender'];
        
        return Yii::app()->mail->send($message);
    }
    
    public static function getSigner()
    {
        $private = Yii::app()->params['DKIM_Key'];
        $domain = 'mydomain.com';
        $selector = Yii::app()->params['DKIM_Selector'];
        
        return new Swift_Signers_DKIMSigner($private,$domain,$selector);
    }
    
    public static function getPlainTextVersion($message, $params)
    {
        $path = Yii::getPathOfAlias(Yii::app()->mail->viewPath);
        $plainViewPath =  $path . DIRECTORY_SEPARATOR . $message->view .'.plain.php';
        
        if(!file_exists($plainViewPath)) {
            return strip_tags(strtr($message->getBody(),array("\t"=>'', '&nbsp;'=>' ','<br>'=>"\n",'<br/>'=>"\n",'<br />'=>"\n",'</p>'=>"\n\n")));    
        }
        
        if(isset(Yii::app()->controller)) {
            $controller = Yii::app()->controller;
        } else {
            $controller = new CController('YiiMail');
        }
        
        $body = $controller->renderInternal($plainViewPath, $params, true);
        $footer = $controller->renderInternal($path . DIRECTORY_SEPARATOR . 'footer.plain.php', null, true);
        
        return $body . PHP_EOL . PHP_EOL . $footer;
    }
} 
