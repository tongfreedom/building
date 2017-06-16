<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name'=>'TGDE : Thai-German Dual Education and e-Learning Development Institute',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    // 'language'=>'th_TH',
    'modules' => [
        // yii2-admin
        //'admin' => [
            //'class' => 'mdm\admin\Module',
           // 'layout' => 'left-menu',
           // 'mainLayout' => '@app/../backend/themes/bsb/views/layouts/main.php',
       // ],
        // yii2-user
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            // 'enableRegistration' => false,
            // 'enableAutoLogin' => true,
            //  'authTimeout' => 86400,
            'rememberFor' => 1209600,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'mailer' => [
                // 'class' => 'backend\components\mail',
                'sender'  => 'admin@freedom.com',
                'welcomeSubject'        => 'Welcome To Green',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
            'controllerMap' => [
                'security' => [
                  'class' => 'backend\controllers\user\SecurityController',
                  'layout' => '@backend/themes/bsb/views/layouts/login',
                ],
                'recovery' => [
                  'class' => 'backend\controllers\user\RecoveryController',
                  'layout' => '@backend/themes/bsb/views/layouts/login',
                ],
                'admin' => [
                  'class' => 'backend\controllers\user\AdminController',
                ],
            ],
            'modelMap' => [
                'User' => 'backend\models\User',
            ],
            
        ],
    ],
    'components' => [
         'authManager' => [
            'class' => 'yii\rbac\DbManager' // 'yii\rbac\PhpManager', // or use 
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'arnon.r@tgde.kmutnb.ac.th',
                'password' => 'tong7529',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/bsb',
                'baseUrl' => '@web/../backend/themes/bsb',
                'pathMap' => [
                    '@app/views' => '@backend/themes/bsb/views',
                    '@dektrium/user/views' => '@app/views/user',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/../backend/themes/bsb/assets',
                    'js' => [
                        'plugins/jquery/jquery.min.js',
                    ],
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/../backend/themes/bsb/assets',
                    'css' => [
                        'bootstrap.css' => 'plugins/bootstrap/css/bootstrap.css'
                    ]
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            // 'identityClass' => 'common\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
                    'basePath' => '@backend/messages',
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'lan' => 'lan.php',
                    ],
                ],
            ],
        ],
        'mdate' => [
            'class' => 'common\components\Mdate',
        ],
        'mtag' => [
            'class' => 'common\components\Mtag',
        ],
        'mpic' => [
            'class' => 'common\components\Mpic',
        ],
        'mdoc' => [
            'class' => 'common\components\Mdoc',
        ],
        'mcheckbox' => [
            'class' => 'common\components\Mcheckbox',
        ],
        'mhelpers' => [
            'class' => 'common\components\Mhelpers',
        ],

        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/tgde/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    /* 'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'user/*',
            'admin/*',
            'site/*',
            'uploadfroala/*',
        ]
    ],*/
    'params' => $params,
];
