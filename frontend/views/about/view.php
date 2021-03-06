<?php
use yii\helpers\Html;
use frontend\models\About;

$this->title = Yii::t('lan','About Us');

$assets = $this->theme->baseUrl.'/assets';
$upload_path = Yii::$app->request->baseurl.'/upload';
?>

<!-- Title -->
<section id="page-title" class="background-dark text-light" style="background-image: url('<?=$assets; ?>/images/bg_title.jpg')">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><?=$this->title?></h1>
            <span><?=Yii::t('lan','TGDE'); ?></span>
        </div>
        <div class="breadcrumb col-md-4">
            <ul>
                <li>
                    <?=Html::a('<i class="fa fa-home"></i>',['site/index']) ?>
                </li>
                <li class="active"  style="color:#fe7300 !important;">
                    <?=Html::a($model->about_title,['about/view','id' => $model->about_id]); ?>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- CONTENT -->
<section class="content p-t-50 p-b-0" style="background-color: #fff;">
    <div class="container">
        <div class="row">

            <!-- Blog post-->
            <div class="post-content post-content-single col-md-9">
                <!-- Post item-->
                <div class="post-item">
                    <!-- detail -->
                    <div class="post-content-details">
                        <div class="post-title">
                            <h2><?=$model->about_title; ?></h2>
                        </div>
                        <div class="post-info">
                            <span class="post-autor"><?=Yii::t('lan','Post by') ?> : 
                                <a href="#"><?=$model->profile->fullname($model); ?></a>
                            </span>
                        </div>

                        <div class="post-description responsive">
                           <?=$model->about_detail; ?>
                        </div>
                    </div>
                    <!-- meta -->
                </div>
                <div class="post-meta">
                    <div class="post-date" title="<?=Yii::t('lan','Update Date'); ?>" alt="<?=Yii::t('lan','Update Date'); ?>">
                         <i class="fa fa-calendar"></i>
                        <span class="post-comments-number">
                            <?php 
                                // $year = Yii::$app->Formatter->asDate($model->update, 'php:Y');

                                // if(Yii::$app->languages->id == 1){
                                //     $year = $year+543;
                                // }
                                echo Yii::$app->Formatter->asDate($model->create, 'php:d/m/Y');
                            ?>
                        </span>
                    </div>

                    <div class="post-comments" title="<?=Yii::t('lan','User Views'); ?>" alt="<?=Yii::t('lan','User Views'); ?>">
                        <i class="fa fa-users"></i>
                        <span class="post-comments-number">
                            <?=$model->about_view; ?>
                        </span>
                    </div>

                    <div class="post-comments">
                    </div>
                </div>
            </div>

            <!-- Sidebar-->
            <div class="sidebar sidebar-modern col-md-3">
                <!-- Tags -->
                <div class="widget clearfix widget-tags">
                    <h4 class="widget-title" style="color:#fe7300;">
                         <i class="fa fa-tag"></i> Tags
                    </h4>
                    <div class="tags">
                        <?php 
                            $tag = Yii::$app->mtag->gettag($model->tag_id);
                            foreach ($tag as $tg) {
                               echo Html::a($tg,['#']);
                            }
                        ?>
                    </div>
                </div>

                <!-- About Us -->
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title" style="color:#fe7300;">
                        <i class="fa fa-info-circle"></i> 
                        <?=Yii::t('lan','About Us'); ?>
                    </h4>
                    <ul class="list list-lines">
                        <?php  
                            foreach ($about as $ab) {
                        ?>
                            <li>
                                <?=Html::a($ab->about_title,['about/view','id' => $ab->about_id],[
                                    'title' => $ab->about_title,
                                    'alt' => $ab->about_title,
                                ]); ?>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- END: Sidebar-->
        </div>
    </div>
</section>
<!-- END: SECTION -->