<?php

namespace backend\themes\bsb;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = '@backend/themes/bsb/assets';

    public $css = [
        // Google Fonts
        'https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext',
        'https://fonts.googleapis.com/icon?family=Material+Icons',

        // Bootstrap Core Css
        // 'plugins/bootstrap/css/bootstrap.css',

        // Wave Effect Css
        'plugins/node-waves/waves.css',

        // Animation Css
        'plugins/animate-css/animate.css',

        // Custom Css
        'css/style.css',

    ];
    public $js = [
        // Jquery Core Js
        // 'plugins/jquery/jquery.min.js',

        // Bootstrap Core Js
        'plugins/bootstrap/js/bootstrap.js',

        // Waves Effect Plugin Js
        'plugins/node-waves/waves.js',

        // Validation Plugin Js
        'plugins/jquery-validation/jquery.validate.js',
       
        // Custom Js
        'js/admin.js',
        'js/pages/examples/sign-in.js',
        // 'js/pages/examples/forgot-password.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
