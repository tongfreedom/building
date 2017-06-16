<?php
use yii\helpers\Html;

$this->title = Yii::t('lan','Gallery').' '.$gallery->gall_title;

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
    <div class="container">
        <div class="row">

            <!-- Blog post-->
            <div class="post-content post-content-single col-md-12">
                <div class="hr-title hr-long center"><abbr><?=$gallery->gall_title; ?></abbr> </div>

                    <!--Gallery masonory -->
                    <div id="isotope" class="isotope col-small-margins portfolio-basic-image" data-isotope-mode="masonry" data-isotope-col="3" data-isotope-item-space="0" data-lightbox-type="gallery" data-isotope-item=".portfolio-item">
                        <?php foreach ($model as $md) : ?>
                        <div class="col-md-3" style="margin-bottom: 20px;">
                            <div class="effect social-links">
                                <?=Html::img($upload_path.'/gallery/thumb/'.$md->pic_img) ?>
                                <div class="image-box-content">
                                    <p>
                                        <?=Html::a('<i class="fa fa-expand"></i>',Yii::$app->request->baseUrl.'/upload/gallery/'.$md->pic_img,['title' => $gallery->gall_title,'data-lightbox' => 'gallery-item']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                       
                        <?php endforeach; ?>
                    </div>
             
                <div class="clearfix"></div>
                <br>
                <div class="post-meta">
                    <div class="post-date" title="<?=Yii::t('lan','Create Date'); ?>" alt="<?=Yii::t('lan','Create Date'); ?>">
                        <?php 
                            // $year = Yii::$app->Formatter->asDate($gallery->create, 'php:Y');

                            // if(Yii::$app->languages->id == 1){
                            //     $year = $year+543;
                            // }
                            echo Yii::$app->Formatter->asDate($gallery->create, 'php:d F Y');
                        ?>
                    </div>

                    <div class="post-comments" title="<?=Yii::t('lan','User Views'); ?>" alt="<?=Yii::t('lan','User Views'); ?>" style="color:green">
                        <i class="fa fa-users"></i>
                        <span class="post-comments-number"><?=$gallery->gall_view; ?></span>
                    </div> 
                </div>
                <!--END: Gallery masonory -->
                <hr>
                 <!--widget tags -->
                <div class="widget clearfix widget-tags">
                    <h4 class="widget-title" style="color:#fe7300;">Tags</h4>
                    <div class="tags">
                        <?php 
                            $tag = Yii::$app->mtag->gettag($gallery->tag_id);
                            foreach ($tag as $value) {
                                echo Html::a($value,'#');
                            }
                        ?>
                    </div>
                </div>
                <!--end: widget tags -->

            </div>
            <!-- END: Blog post-->

        </div>
    </div>
</section>
<!-- END: SECTION -->