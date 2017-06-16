<?php
use yii\helpers\Html;

$this->title = Yii::t('lan','Portfolio');

$upload_path = Yii::$app->request->baseurl.'/upload';
$assets = $this->theme->baseUrl.'/assets';
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
                    <?=Html::a($this->title,['work/index']); ?>
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

                    <div class="post-title">
                        <h3><?=$model->work_title; ?></h3>
                    </div>
                    <div class="post-info">
                        <span class="post-autor"><?=Yii::t('lan','Post by'); ?> : <?=$model->profile->name; ?></span>
                        |
                        <span class="post-comments-number"><?=Yii::t('lan','Type');?> : <?=$model->type->type_name; ?></span>
                    </div>

                    <div class="post-image">
                        <?=Html::a(Html::img(Yii::$app->request->baseUrl.'/upload/work/thumb/'.$model->work_img,['alt' => $model->work_title,'title' => $model->work_title,'class' => 'img-rounded img-responsive']),$upload_path.'/work/'.$model->work_img,['target' => '_blank']); ?>
                    </div>

                    <div class="post-content-details">
                       
                        <div class="post-description">
                           <?=$model->work_detail; ?>
                        </div>
                    </div>
                </div>

                <div class="post-meta">
                    <div class="post-date" title="<?=Yii::t('lan','Create Date'); ?>" alt="<?=Yii::t('lan','Create Date'); ?>">
                         <i class="fa fa-calendar"></i>
                        <span class="post-comments-number">
                            <?php 
                                // $year = Yii::$app->Formatter->asDate($model->update, 'php:Y');

                                // if(Yii::$app->languages->id == 1){
                                //     $year = $year+543;
                                // }
                                echo Yii::$app->Formatter->asDate($model->create, 'php:d/m/Y')
                            ?>
                        </span>
                    </div>

                    <div class="post-comments" title="<?=Yii::t('lan','User Views'); ?>" alt="<?=Yii::t('lan','User Views'); ?>">
                        <i class="fa fa-users"></i>
                        <span class="post-comments-number">
                            <?=$model->work_view; ?>
                        </span>
                    </div>

                    <div class="post-comments">
                    </div>
                </div>

            </div>
            <!-- END: Blog post-->

            <!-- Sidebar-->
            <div class="sidebar sidebar-modern col-md-3">
                <!--widget tags -->
                <div class="widget clearfix widget-tags">
                    <h4 class="widget-title" style="color:#fe7300;">
                        <i class="fa fa-tag"></i> Tags
                    </h4>
                    <div class="tags">
                        <?php 
                            $tag = Yii::$app->mtag->gettag($model->tag_id);
                            foreach ($tag as $value) {
                                echo Html::a($value,'#');
                            }
                        ?>
                    </div>
                </div>
                <!--end: widget tags -->

                <!--widget blog articles-->
                <div class="widget clearfix widget-blog-articles">
                    <h4 class="widget-title" style="color:#fe7300;">
                        <i class="fa fa-star"></i> 
                        <?=Yii::t('lan', 'Popular Portfolios'); ?>
                    </h4>
                    <ul class="list-posts list-medium">
                        <?php foreach ($work_hit as $hit) : ?>
                        <li>
                            <?=Html::a($hit->work_title,['work/view','id' => $hit->work_id]); ?>
                            <small>
                                <?=Yii::$app->Formatter->asDateTime($hit->create, 'php:d F Y'); ?>
                            </small>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--end: widget blog articles-->
            </div>
            <!-- END: Sidebar-->
        </div>
    </div>
</section>
<!-- END: SECTION -->