<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'languages' => [
            'class' => 'common\components\Languages',
        ],
        // yii2-admin
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'Languages'=>[
            'class'=>'app\components\Languages'
        ],
    ],
];
