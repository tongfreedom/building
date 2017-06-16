<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/frontend/themes/polo',
                'baseUrl' => '@web/frontend/themes/polo',
                'pathMap' => [
                    '@app/views' => '@frontend/themes/polo/views',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'frontend/themes/polo/assets/vendor/jquery/jquery-1.11.2.min.js',
                    ],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'i18n' => [
            'translations' => [
                'lan*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'language' => ['en', 'th'],
                    'basePath' => '@frontend/messages',
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'lan' => 'lan.php',
                    ],
                ],
            ],

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'mhelpers' => [
            'class' => 'common\components\Mhelpers',
        ],
        'mtag' => [
            'class' => 'common\components\Mtag',
        ],
        'mdate' => [
            'class' => 'common\components\Mdate',
        ],
        
    ],
    'params' => $params,
];
