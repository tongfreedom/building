<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('lan','Gallery');

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
                    <?=Html::a($this->title,['gallery/index']); ?>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- CONTENT -->
<section class="content p-t-50 p-b-0" style="background-color: #fff;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="hr-title hr-long center"><abbr><?=$this->title; ?></abbr> </div>
            
            <!-- Blog post-->
            <div class="post-content col-md-12">
                <!-- Blog post-->
                <div class="isotope" data-isotope-item-space="1" data-isotope-col="4" data-isotope-item=".post-item">
                    <?php foreach($model as $md): ?>

                    <!-- Blog image post-->
                    <div class="post-item">
                        <div class="post-image">
                            <div class="effect social-links">
                                <?=Html::img($upload_path.'/gallery/thumb/'.$md->gall_img,[
                                    'class' => 'ponsive img-responsive img-thumbnail',
                                    'alt' => $md->gall_title,
                                    'title' => $md->gall_title,
                                ]); ?>
                                <div class="image-box-content">
                                    <p>
                                        <?=Html::a('<i class="fa fa-picture-o"></i>',['gallery/view','id' => $md->gall_id],[
                                            'data-lightbox-type' => 'url', 
                                            'alt' => $md->gall_title,
                                            'title' => $md->gall_title]); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="post-content-details">
                            <div class="post-title">
                                <h4>
                                    <?=Html::a($md->gall_title,['gallery/view','id' => $md->gall_id]); ?>
                                </h4>
                            </div>

                            <div class="post-description">
                                <p>
                                    <?php
                                       echo Yii::$app->mhelpers->subdetail($md->gall_detail,150);
                                    ?>
                                </p>

                                <div class="post-info">
                                    <?=Html::a(Yii::t('lan','read more').' <i class="fa fa-long-arrow-right"></i>',['gallery/view','id' => $md->gall_id],['class' => 'read-more','style' => 'color:#fe7300']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="post-meta">
                            <div class="post-date" title="<?=Yii::t('lan','Create Date'); ?>" alt="<?=Yii::t('lan','Create Date'); ?>">

                                <?php 
                                    // $year = Yii::$app->Formatter->asDate($md->create, 'php:Y');

                                    // if(Yii::$app->languages->id == 1){
                                    //     $year = $year+543;
                                    // }
                                    echo Yii::$app->Formatter->asDate($md->create, 'php:d F Y');
                                ?>
                            </div>

                            <div class="post-comments" title="<?=Yii::t('lan','User Views'); ?>" alt="<?=Yii::t('lan','User Views'); ?>" style="color:green">
                                <i class="fa fa-users"></i>
                                <span class="post-comments-number"><?=$md->gall_view; ?></span>
                            </div> 

                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
                <!-- END: Blog post-->
        
                <!-- pagination nav -->
                <div class="text-center">
                    <div class="pagination-wrap">
                    <?php 
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                    ?>
                    </div>
                </div>
       
            </div>
        </div>
    </div>
</section>
<!-- END: SECTION -->