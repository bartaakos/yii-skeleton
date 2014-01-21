<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray(
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'Console',
        'import' => array(
            'application.models.*',
            'application.components.*',
            'ext.giix.components.*',
            'ext.giix.helpers.*',
            'ext.yii-mail.*',
        ),
        // application components
        'components' => array(
            'authManager' => array(
                'class' => 'CDbAuthManager',
                'connectionID' => 'db',
                'itemTable' => 'authitem',
                'itemChildTable' => 'authitemchild',
                'assignmentTable' => 'authassignment',
                'defaultRoles' => array('authenticated', 'guest'),
            ),
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'url_rules.php'),
            ),
            'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType' => 'php',
                'viewPath' => 'application.views.mail',
                'logging' => true,
                'dryRun' => false
            ),
        ),
        'params' => require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'params.php'),
    ),
    require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'custom.php'));