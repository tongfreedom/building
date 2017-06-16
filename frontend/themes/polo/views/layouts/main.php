<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\themes\polo\PoloAsset;
use common\widgets\Alert;
use frontend\models\Footer;
use frontend\models\Link;
use frontend\models\About;
use frontend\models\Services;
use frontend\models\Type;

PoloAsset::register($this);

$base_url = Yii::$app->request->baseUrl;
$assets = $this->theme->baseUrl.'/assets';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="images/favicon.png">
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>

<body class="wide">
<?php $this->beginBody() ?>

    <!-- HEADER -->
    <header id="header" class="header-dark">
        <div id="header-wrap">
            <div class="container">

                <!--LOGO-->
                <div id="logo">
                    <?=Html::a(Html::img($assets.'/images/logo-tgde.png',[
                        'alt' => Yii::t('lan','TGDE'),
                        'title' => Yii::t('lan','TGDE'),
                    ]),['site/index'],['class' => 'logo','data-dark-logo' => $assets.'/images/logo-tgde.png']); ?>
                </div>
                <!--END: LOGO-->

                <!--MOBILE MENU -->
                <div class="nav-main-menu-responsive">
                    <button class="lines-button x">
                        <span class="lines"></span>
                    </button>
                </div>
                <!--END: MOBILE MENU -->

                <!--TOP SEARCH -->
                <div id="top-search">
                    <a id="top-search-trigger">
                        <i class="fa fa-search" title="<?=Yii::t('lan','Search'); ?>" alt="<?=Yii::t('lan','Search'); ?>"></i>
                        <i class="fa fa-close"></i>
                    </a>
                    <form action="search-results-page.html" method="get">
                        <input type="text" name="q" class="form-control" value="" placeholder="<?=Yii::t('lan','Search'); ?>">
                    </form>
                </div>
                <!--END: TOP SEARCH -->

                <!--NAVIGATION-->
                <?php
                    $about = About::find()->where([
                        'active' => 1,
                        'lan_id' => Yii::$app->languages->id,
                    ])->orderBy(['about_order' => SORT_ASC,'create' => SORT_DESC])->all();
                    $about_arr = [];

                    foreach ($about as $ab) {
                        array_push($about_arr,[
                            'type' => 'normal',
                            'name' =>'<i class="fa fa-info-circle"></i>'.$ab->about_title,
                            'link' => ['about/view','id' => $ab->about_id]
                        ]);
                    }

                    array_push($about_arr, [
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-user"></i>'.Yii::t('lan','Team'),
                        'link' => ['team/index'],
                    ]);

                    // Dual Education
                    $dual_education_arr = [];

                    $type = Type::find()->where([
                        'active' => 1,
                        'type_id' => [1,2],
                        'lan_id' => Yii::$app->languages->id,
                    ])->one();

                    array_push($dual_education_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-newspaper-o"></i>'.Yii::t('lan','News').$type->type_name,
                        'link' => ['news/index','type_id' => $type->type_id]
                    ]);

                    array_push($dual_education_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-list-ul"></i>'.Yii::t('lan','Article'),
                        'link' => ['article/index','type_id' => $type->type_id]
                    ]);

                    array_push($dual_education_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-cloud-download"></i>'.Yii::t('lan','Download Document'),
                        'link' => ['document/index','type_id' => $type->type_id]
                    ]);

                    array_push($dual_education_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-question-circle"></i>'.Yii::t('lan','Faq'),
                        'link' => ['faq/index','type_id' => $type->type_id]
                    ]);
                    // End Dual Education
                    
                    // Develop
                    $dev_arr = [];

                    $type = Type::find()->where([
                        'active' => 1,
                        'type_id' => [3,4],
                        'lan_id' => Yii::$app->languages->id,
                    ])->one();

                    array_push($dev_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-newspaper-o"></i>'.Yii::t('lan','News').$type->type_name,
                        'link' => ['news/index','type_id' => $type->type_id]
                    ]);

                    array_push($dev_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-list-ul"></i>'.Yii::t('lan','Article'),
                        'link' => ['article/index','type_id' => $type->type_id]
                    ]);

                    array_push($dev_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-cloud-download"></i>'.Yii::t('lan','Download Document'),
                        'link' => ['document/index','type_id' => $type->type_id]
                    ]);

                    array_push($dev_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-question-circle"></i>'.Yii::t('lan','Faq'),
                        'link' => ['faq/index','type_id' => $type->type_id]
                    ]);
                    // End Develop
                    
                    // Office
                    $office_arr = [];

                    $type = Type::find()->where([
                        'active' => 1,
                        'type_id' => [5,6],
                        'lan_id' => Yii::$app->languages->id,
                    ])->one();

                    array_push($office_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-newspaper-o"></i>'.Yii::t('lan','News').$type->type_name,
                        'link' => ['news/index','type_id' => $type->type_id]
                    ]);

					array_push($office_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-list-ul"></i>'.Yii::t('lan','Article'),
                        'link' => ['article/index','type_id' => $type->type_id]
                    ]);

                    array_push($office_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-cloud-download"></i>'.Yii::t('lan','Download Document'),
                        'link' => ['document/index','type_id' => $type->type_id]
                    ]);

                    array_push($office_arr,[
                        'type' => 'normal',
                        'name' =>'<i class="fa fa-question-circle"></i>'.Yii::t('lan','Faq'),
                        'link' => ['faq/index','type_id' => $type->type_id]
                    ]);
                    // End Office

                    $services = Services::find()->where([
                        'active' => 1,
                        'lan_id' => Yii::$app->languages->id,
                    ])->orderBy(['service_order' => SORT_ASC, 'create' => SORT_ASC])->all();

                    $services_arr = [];
                    foreach ($services as $sv) {
                        array_push($services_arr,[
                            'type' => 'normal',
                            'name' =>'<i class="fa fa-book"></i>'.$sv->service_name,
                            'link' => $sv->service_url
                        ]);
                    }

                    $item = [
                        [
                            'type' => 'normal',
                            'name' =>'<i class="fa fa-home" title="'.Yii::t('lan','Home').'"></i>',
                            'link' => ['site/index']
                        ],
                        [
                            'type' => 'dropdown',
                            'name' =>Yii::t('lan','About'),
                            'link' => '#',
                            'sub' => $about_arr,
                        ],
                        [
                            'type' => 'dropdown',
                            'name' => Yii::t('lan','Dual Education'),
                            'link' => '#',
                            'sub' => $dual_education_arr,
                        ],
                        [
                            'type' => 'dropdown',
                            'name' => Yii::t('lan','Develop'),
                            'link' => '#',
                            'sub' => $dev_arr,
                        ],
                        [
                            'type' => 'dropdown',
                            'name' => Yii::t('lan','Office'),
                            'link' => '#',
                            'sub' => $office_arr,
                        ],
                        [
                            'type' => 'dropdown',
                            'name' => Yii::t('lan','Services'),
                            'link' => '#',
                            'sub' => $services_arr,
                        ],
                        [
                            'type' => 'normal',
                            'name' => Yii::t('lan','Portfolio'),
                            'link' => ['work/index'],
                        ],
                        [
                            'type' => 'normal',
                            'name' => Yii::t('lan','Contact'),
                            'link' => ['contact/index'],
                        ],
                    ];
                ?>
                <div class="navbar-collapse collapse main-menu-collapse navigation-wrap">
                    <div class="container">
                        <nav id="mainMenu" class="main-menu mega-menu">
                            <ul class="main-menu nav nav-pills">
                                <?php foreach ($item as $menu): ?>
                                    <?php  
                                        if($menu['type'] == 'dropdown'){
                                   
                                            echo '<li class="dropdown">';
                                            echo Html::a($menu['name'].'<i class="fa fa-angle-down"></i>',$menu['link']);

                                            echo '<ul class="dropdown-menu">';

                                            foreach ($menu['sub'] as $ms) {
                                            echo '<li>';
                                            echo Html::a($ms['name'],$ms['link']);
                                            echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '</li>';
                                     ?>
                                    <?php
                                        }else{
                                            echo '<li>';
                                            echo Html::a($menu['name'],$menu['link']);
                                            echo '</li>';
                                        }
                                    ?>
                                <?php endforeach ?>
                            </ul>
                        </nav>`
                    </div>
                </div>
                <!--END: NAVIGATION-->
            </div>
        </div>
    </header>
    <!-- END: HEADER -->


    <!-- TOPBAR -->
    <div id="topbar">
        <div class="container">
            <div class="topbar-dropdown"  style="margin-left:-30px;">
                <div class="title">
           <!--          Html::a(Html::img($assets.'/images/flag/thai.jpg',['style' => 'width:30px;']),['site/changelg','id'=>1],['title' => 'Thai', 'alt' => 'Thai']); -->

                 
                    <!-- echo Html::a(Html::img($assets.'/images/flag/english.jpg',['style' => 'width:30px;']),['site/changelg','id'=>2],['title' => 'English', 'alt' => 'English']);  -->
                   
                </div>
            </div>
           <!--  <div class="topbar-dropdown">
                <div class="title">
                    <i class="fa fa-user"></i><a href="#">ลงชื่อเข้าสู่ระบบ</a>
                </div>

                <div class="topbar-form">
                    <form>
                        <div class="form-group">
                            <label class="sr-only">ชื่อเข้าใช้งาน</label>
                            <input type="text" placeholder="ชื่อเข้าใช้งาน" class="form-control">

                        </div>
                        <div class="form-group">
                            <label class="sr-only">รหัสผ่าน</label>
                            <input type="password" placeholder="รหัสผ่าน" class="form-control">
                        </div>
                        <div class="form-inline form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    <small> จดจำรหัสผ่าน</small> </label>
                            </div>
                            <button type="button" class="btn btn-tgde btn-block">ลงชื่อเข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div> -->
            <div class="topbar-dropdown">
                <div class="title"><i class="fa"></i></div>
            </div>
            <div class="hidden-xs">
                <div class="social-icons social-icons-colored-hover">
                    <ul>
                        <li class="social-facebook">
							<a href="https://www.facebook.com/KMUTNB.TGDE/" target="_blank"><i class="fa fa-facebook"></i></a>
							
						</li>
                     <!--   <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="social-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: TOPBAR -->
    
    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- CONTENT -->
        <?=$content; ?>
        <!-- END: SECTION -->

        <!-- FOOTER -->
        <?php 
            $footer = Footer::find()->where([
                'active' => 1, 
                'lan_id' => Yii::$app->languages->id
            ])->one(); 
        ?>
        <footer class="background-dark text-grey" id="footer">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer-logo float-left">
                                <img alt="<?=Yii::t('lan','TGDE'); ?>" title="<?=Yii::t('lan','TGDE'); ?>" src="<?=$assets; ?>/images/logo-tgde-footer.png">
                            </div>
                            <p class="m-t-10">
                                <?=$footer->foot_detail; ?>
                            </p>
                        </div>
                    </div>
                    <div class="seperator seperator-dark seperator-simple"></div>

                    <!-- CONTACT LINK LETTER  -->
                    <div class="row">
                        <!-- Contact -->
                        <div class="col-md-4">
                            <div class="widget clearfix widget-contact-us" id="footer-contact">
                                <h4 class="widget-title">
                                    <?=Yii::t('lan','Contact Us'); ?>
                                </h4>
                                <ul class="list-large list-icons">
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        <strong><?=Yii::t('lan','Address'); ?> :</strong>
                                        <?=$footer->foot_address; ?>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <strong><?=Yii::t('lan','Phone'); ?> :</strong> 
                                        <?=$footer->foot_tel; ?>
                                    </li>

                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <strong><?=Yii::t('lan','Email'); ?> :</strong> 
                                        <a href="mailto:<?=$footer->foot_email; ?>">
                                            <?=$footer->foot_email; ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- External Link -->
                        <?php 
                            $ex_link = Link::find()->where([
                                'lan_id'=> Yii::$app->languages->id,
                                'active' => 1,
                            ])->orderBy(['link_order' => SORT_ASC])->all();
                        ?>
                        <div class="col-md-4">
                            <h4 class="widget-title"><?=Yii::t('lan','External Link'); ?></h4>
                            <ul class="list-large list-icons footer-link">
                                <?php  
                                    foreach ($ex_link as $link) {
                                        echo '<li>';
                                        echo Html::a('<i class="fa fa-external-link"></i> '.$link->link_name,$link->link_url,['target' => '_blank']);
                                        echo '</li>';
                                    }
                                ?>
                            </ul>
                        </div>

                        <!-- Subscribe -->
                        <div class="col-md-4">
                            <div class="widget clearfix widget-newsletter">
                                <form id="widget-subscribe-form" action="include/subscribe-form.php" role="form" method="post" class="form-inline">
                                    <h4 class="widget-title">จดหมายข่าว</h4>
                                    <small>รับจดหมายข่าวล่าสุด !</small>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                        <input type="email" aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="โปรดระบุอีเมลของท่าน">
                                        <span class="input-group-btn">
                                            <button type="submit" id="widget-subscribe-submit-button" class="btn btn-tgde">รับจดหมายข่าว</button>
                                        </span>
                                    </div>
                                </form>
                                <script type="text/javascript">
                                    jQuery("#widget-subscribe-form").validate({
                                        submitHandler: function(form) {
                                            jQuery(form).ajaxSubmit({
                                                dataType: 'json',
                                                success: function(text) {
                                                    if (text.response == 'success') {
                                                        $.notify({
                                                            message: "You have successfully subscribed to our mailing list."
                                                        }, {
                                                            type: 'success'
                                                        });
                                                        $(form)[0].reset();

                                                    } else {
                                                        $.notify({
                                                            message: text.message
                                                        }, {
                                                            type: 'warning'
                                                        });
                                                    }
                                                }
                                            });
                                        }
                                    });
                                  </script>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTACT LINK LETTER -->
                </div>
            </div>
            <!-- Copyright -->
            <div class="copyright-content">
                <div class="container">
                    <div class="row">
                        <!-- Copyright -->
                        <div class="copyright-text col-md-8"> 
                            <?=Yii::t('lan','copyright'); ?>
                            <a target="_blank" href="#" id="freedom">Coding By Tongfreedom</a>
                        </div>
                        <!-- Social Footer -->
                        <div class="col-md-4">
                            <div class="social-icons">
                                <ul>
                                    <li class="social-facebook"><a href="https://www.facebook.com/KMUTNB.TGDE/" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<!--
                                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="social-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: FOOTER -->

    </div>
    <!-- END: WRAPPER -->

    <!-- GO TOP BUTTON -->
    <a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>
    
    <?php  
        // Theme Base, Components and Settings
        echo Html::jsFile($assets.'/js/theme-functions.js');
        // Custom js file
        echo Html::jsFile($assets.'/js/custom.js');
    ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>