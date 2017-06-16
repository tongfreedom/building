<?php
use yii\helpers\Html;

$this->title = Yii::t('lan','News').$model->type->type_name;
if($model->news_price == 1){
	$this->title = Yii::t('lan','News').Yii::t('lan','Annouce & Tender');
}

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
                    <?=Html::a($this->title,['news/index','type_id' => $model->type_id]); ?>
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
                        <h3><?=$model->news_title; ?></h3>
                    </div>
                    <div class="post-info">
                        <span class="post-autor"><?=Yii::t('lan','Post by'); ?> : <?=$model->profile->name; ?></span>
                        |
                        <span class="post-comments-number"><?=Yii::t('lan','Type');?> : <?php if($model->news_price == 1){echo Yii::t('lan','Annouce & Tender');}else{echo $model->type->type_name;} ?></span>
                    </div>
					<?php if($model->news_price == 0){ ?>
                    <div class="post-image">
                        <?=Html::a(Html::img(Yii::$app->request->baseUrl.'/upload/news/thumb/'.$model->news_img,['alt' => $model->news_title,'title' => $model->news_title,'class' => 'img-rounded img-responsive']),$upload_path.'/news/'.$model->news_img,['target' => '_blank']); ?>
                    </div>
					<?php } ?>
                    <div class="post-content-details">
                       
                        <div class="post-description">
                           <?=$model->news_detail; ?>
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
                            <?=$model->news_view; ?>
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
                        <i class="fa fa-newspaper-o"></i>
                        <?=Yii::t('lan', 'Popular News'); ?>
                    </h4>
                    <ul class="list-posts list-medium">
                        <?php foreach ($news_hit as $hit) : ?>
                        <li>
                            <?=Html::a($hit->news_title,['news/view','id' => $hit->news_id]); ?>
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