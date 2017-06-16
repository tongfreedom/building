<?php

use backend\themes\bsb\AdminbsbAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;

AdminbsbAsset::register($this);
$assets = $this->theme->baseUrl.'/assets';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title>
        <?=Html::encode(preg_replace('#\<i class="material-icons">[{\w},\s\d"]+\</i>#', "", $this->title)) ?>
    </title>
    
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>

<body class="theme-red">
<?php $this->beginBody() ?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>


                <a href="javascript:void(0);" class="bars"></a>

                <?php
                echo Html::a('TGDE : Thai-German Dual Education and e-Learning Development Institute',['site/index'],['class' => 'navbar-brand']);

                ?>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li>
                        <a href="javascript:void(0);" class="js-search" data-close="true">
                            <i class="material-icons">search</i>
                        </a>
                    </li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Tasks -->
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info" style="height:105px;">
                <div class="col-md-3" >
                <div class="image">
                    <img src="<?=$assets; ?>/images/user.png" width="68" height="68" alt="User" />
                </div>
                    
                </div> 
                <div class="col-md-8 col-md-offset-1">
                    <div class="info-container" style="text-align:left;">
                    <div class="email"><?=Yii::$app->user->identity->profile->public_email; ?></div>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?
                            echo Yii::$app->user->identity->profile->name.' '.Yii::$app->user->identity->profile->lastname; 
                        ?>
                    </div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <?=Html::a('<i class="material-icons">person</i>Profile',[
                                    '/user/settings/profile'
                                ]); ?>
                            </li>
                            <li role="seperator" class="divider"></li>
                            <li>
                                <?=Html::a('<i class="material-icons">input</i>Logout',[
                                    '/user/security/logout'],['data-method' => 'post']);
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                </div> 
                
            </div>
            <!-- #User Info -->
            
            <!-- Menu -->
            <div class="menu">

            <?php  
            if(Yii::$app->user->identity->username == "admin"){
                echo Menu::widget([
                    'items' => [
                        [
                            'label' => 'Main Menu',
                            'url' => '',
                            'template' => '{label}',
                            'options'=>['class'=>'header'],
                        ],
                        [
                            'label' => '<i class="material-icons">home</i><span>Home</span>', 
                            'url' => ['/site/index']
                        ],
                        [
                            'label' => '<i class="material-icons">chrome_reader_mode</i><span>News</span>', 
                            'url' => ['/news/index']
                        ],
                        [
                            'label' => '<i class="material-icons">library_books</i><span>Article</span>', 
                            'url' => ['/article/index']
                        ],
                        [
                            'label' => '<i class="material-icons">stars</i><span>Portfolio</span>', 
                            'url' => ['/work/index']
                        ],
                        [
                            'label' => '<i class="material-icons">description</i><span>Document</span>', 
                            'url' => 'javascript:void(0)',
                            'template' => '<a href="{url}" class="menu-toggle">{label}</a>',
                            'items' => [
                                ['label' => 'Document', 'url' => ['/document/index','id' => 1]],
                                ['label' => 'Document Type', 'url' => ['/documenttype/index']],
                            ]
                        ], 
                        [
                            'label' => '<i class="material-icons">video_library</i><span>Video</span>', 
                            'url' => ['/vdo/index']
                        ],
                        [
                            'label' => '<i class="material-icons">image</i><span>Gallery</span>', 
                            'url' => ['/gallery/index']
                        ],
                        [
                            'label' => '<i class="material-icons">slideshow</i><span>Slide</span>', 
                            'url' => ['/slide/index']
                        ],
                        [
                            'label' => '<i class="material-icons">business</i><span>Company</span>', 
                            'url' => ['/company/index']
                        ],
                        [
                            'label' => '<i class="material-icons">email</i><span>Mail</span>', 
                            'url' => ['/mail/index']
                        ],
                        [
                            'label' => 'Static',
                            'url' => '',
                            'template' => '{label}',
                            'options'=>['class'=>'header'],
                        ],
                        [
                            'label' => '<i class="material-icons">help</i><span>FAQ</span>', 
                            'url' => ['/faq/index']
                        ],
                        [
                            'label' => '<i class="material-icons">group</i><span>Team</span>', 
                            'url' => ['/team/index']
                        ],
                        [
                            'label' => '<i class="material-icons">info</i><span>About Us</span>', 
                            'url' => ['/about/index']
                        ],
                        [
                            'label' => '<i class="material-icons">loyalty</i><span>Services</span>', 
                            'url' => ['/services/index']
                        ],
                        [
                            'label' => '<i class="material-icons">contacts</i><span>Footer</span>', 
                            'url' => 'javascript:void(0)',
                            'template' => '<a href="{url}" class="menu-toggle">{label}</a>',
                            'items' => [
                                ['label' => 'Contact', 'url' => ['/footer/update','id' => 1]],
                                ['label' => 'Link', 'url' => ['/link/index']],
                            ]
                        ],
                        [
                            'label' => '<i class="material-icons">assignment_ind</i><span>User</span>', 
                            'url' => ['/user/admin/index']
                        ],
                        [
                            'label' => '<i class="material-icons">settings</i><span>Setting</span>', 
                            'url' => ['/setting/update','id' => 1]
                        ],
                    ],
                    'options' => [
                        'class' => 'list',
                    ],
                    'encodeLabels' => false,
                    'activeCssClass'=>'active',
                    'submenuTemplate' => "\n<ul class='ml-menu'>\n{items}\n</ul>\n",
                ]);
            }else{
                echo Menu::widget([
                'items' => [
                     [
                            'label' => 'Main Menu',
                            'url' => '',
                            'template' => '{label}',
                            'options'=>['class'=>'header'],
                        ],
                        [
                            'label' => '<i class="material-icons">home</i><span>Home</span>', 
                            'url' => ['/site/index']
                        ],
                        [
                            'label' => '<i class="material-icons">chrome_reader_mode</i><span>News</span>', 
                            'url' => ['/news/index']
                        ],
                        [
                            'label' => '<i class="material-icons">library_books</i><span>Article</span>', 
                            'url' => ['/article/index']
                        ],
                        [
                            'label' => '<i class="material-icons">stars</i><span>Portfolio</span>', 
                            'url' => ['/work/index']
                        ],
                        [
                            'label' => '<i class="material-icons">description</i><span>Document</span>', 
                            'url' => 'javascript:void(0)',
                            'template' => '<a href="{url}" class="menu-toggle">{label}</a>',
                            'items' => [
                                ['label' => 'Document', 'url' => ['/document/index','id' => 1]],
                                ['label' => 'Document Type', 'url' => ['/documenttype/index']],
                            ]
                        ], 
                        [
                            'label' => '<i class="material-icons">video_library</i><span>Video</span>', 
                            'url' => ['/vdo/index']
                        ],
                        [
                            'label' => '<i class="material-icons">image</i><span>Gallery</span>', 
                            'url' => ['/gallery/index']
                        ],
                        [
                            'label' => '<i class="material-icons">email</i><span>Mail</span>', 
                            'url' => ['/mail/index']
                        ],
                        [
                            'label' => 'Static',
                            'url' => '',
                            'template' => '{label}',
                            'options'=>['class'=>'header'],
                        ],
                        [
                            'label' => '<i class="material-icons">help</i><span>FAQ</span>', 
                            'url' => ['/faq/index']
                        ],
                    ],
                    'options' => [
                        'class' => 'list',
                    ],
                    'encodeLabels' => false,
                    'activeCssClass'=>'active',
                    'submenuTemplate' => "\n<ul class='ml-menu'>\n{items}\n</ul>\n",
            ]);
            }
            
            ?>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">TGDE - Coding By Freedom</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    <section class="content bread" style="margin-top:80px;">
        <div class="body">
            <!-- <ol class="breadcrumb breadcrumb-bg-cyan">
                <li><a href="javascript:void(0);">
                    <i class="material-icons">home</i> Home</a></li>
                <li class="active"><i class="material-icons">library_books</i> Library</li>
            </ol> -->
        </div>
        <?php
            echo Breadcrumbs::widget([
                'tag' => 'ol',
                'options' => [
                    'class' => 'breadcrumb breadcrumb-bg-grey',
                ],
                'encodeLabels' => false,
                'itemTemplate' => "<li>{link}</li>\n",
                'homeLink' => [
                    'label' => '<i class="material-icons">home</i> Home</a></li>',
                    'url' => ['site/index'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

            ]);
        ?>
    </section>
    <section class="content" style="margin-top:50px;">
        <?php  echo $content; ?> 
            

    </section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $('.bars').show();
</script>