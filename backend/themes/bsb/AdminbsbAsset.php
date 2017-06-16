<?php

namespace backend\themes\bsb;

use yii\web\AssetBundle;

class AdminbsbAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = '@backend/themes/bsb/assets';

    public $css = [

        // Google Fonts
        // 'https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext',
        'https://fonts.googleapis.com/icon?family=Material+Icons',


        'https://fonts.googleapis.com/css?family=Kanit:300|Prompt:300',

        // Bootstrap Core Css
        'plugins/bootstrap/css/bootstrap.css',

        // Wave Effect Css
        'plugins/node-waves/waves.css',

        // Animation Css
        'plugins/animate-css/animate.css',

        'plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',

        // Multi Select
        // 'plugins/multi-select/css/multi-select.css',

        // Wait Me Css
        'plugins/waitme/waitMe.css',

        // Bootstrap Select Css
        'plugins/bootstrap-select/css/bootstrap-select.css',

        // Morris Chart Css
        // 'plugins/morrisjs/morris.css',

        // SweetAlert
        'plugins/sweetalert/sweetalert.css',

        // Custom Css
        'css/style.css',

        // AdminBSB Themes. You can choose a theme from css/themes instead of get all themes
        'css/themes/all-themes.css',

    ];
    public $js = [

        // Jquery Core Js
        // 'plugins/jquery/jquery.min.js',

        // Bootstrap Core Js
        'plugins/bootstrap/js/bootstrap.js',

        // Select Plugin Js
        'plugins/bootstrap-select/js/bootstrap-select.js',

        // Slimscroll Plugin Js
        'plugins/jquery-slimscroll/jquery.slimscroll.js',

        // Waves Effect Plugin Js
        'plugins/node-waves/waves.js',

        // Autosize Plugin Js
        'plugins/autosize/autosize.js',

        //Multi Select
        // 'plugins/multi-select/js/jquery.multi-select.js',

        // CountTo
        'plugins/jquery-countto/jquery.countTo.js',

         // SweetAlert
        'plugins/sweetalert/sweetalert.min.js',
        'js/pages/ui/dialogs_freedom.js',

        // Notify
        'plugins/bootstrap-notify/bootstrap-notify.js',
        'js/pages/ui/notifications.js',

        // Moment Plugin Js
        'plugins/momentjs/moment.js',

        // Bootstrap Material Datetime Picker Plugin Js
        'plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',

        // Morris Plugin Js
        // 'plugins/raphael/raphael.min.js',
        // 'plugins/morrisjs/morris.js',

        // ChartJs
        // 'plugins/chartjs/Chart.bundle.js',

        // Flot Charts Plugin Js
        // 'plugins/flot-charts/jquery.flot.js',
        // 'plugins/flot-charts/jquery.flot.resize.js',
        // 'plugins/flot-charts/jquery.flot.pie.js',
        // 'plugins/flot-charts/jquery.flot.categories.js',
        // 'plugins/flot-charts/jquery.flot.time.js',

        // Sparkline Chart Plugin Js
        'plugins/jquery-sparkline/jquery.sparkline.js',

        // Custom Js
        'js/admin.js',
        'js/script.js',
    
        // Demo Js
        'js/demo.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
