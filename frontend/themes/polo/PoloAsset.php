<?php

namespace frontend\themes\polo;

use yii\web\AssetBundle;

class PoloAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = '@frontend/themes/polo/assets';

    public $css = [

       // Bootstrap Core CSS
        // 'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/fontawesome/css/font-awesome.min.css',
        'vendor/animateit/animate.min.css',

        // Vendor css
        'vendor/owlcarousel/owl.carousel.css',
        'vendor/magnific-popup/magnific-popup.css',

        // Template base
        'css/theme-base.css',

        // Template elements
        'css/theme-elements.css',

        // Responsive classes
        'css/responsive.css',

        // Template color
        // 'css/color-variations/tgde.css',
        'css/color-variations/red-dark.css',

        // LOAD GOOGLE FONTS
        '//fonts.googleapis.com/css?family=Kanit:300|Prompt:300', 

        // SLIDER REVOLUTION 5.x CSS SETTINGS
        // 'vendor/rs-plugin/css/settings.css',

        // CSS CUSTOM STYLE
        'css/custom.css',

    ];
    public $js = [
        // VENDOR SCRIPT
        'vendor/plugins-compressed.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
