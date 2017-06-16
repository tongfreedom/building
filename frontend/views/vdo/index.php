<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('lan','Video');

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
                    <?=Html::a($this->title,['vdo/index']); ?>
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
                                <?=Html::img($upload_path.'/video/thumb/'.$md->vdo_img,[
                                    'class' => 'ponsive img-responsive img-thumbnail',
                                    'alt' => $md->vdo_title,
                                    'title' => $md->vdo_title,
                                ]); ?>
                                <div class="image-box-content">
                                    <p>
                                        <?=Html::a('<i class="fa fa-play"></i>',$md->vdo_url,[
                                            'data-lightbox-type' => 'iframe', 
                                            'alt' => $md->vdo_title,
                                            'title' => $md->vdo_title]); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="post-content-details">
                            <div class="post-title">
                                <h4>
                                    <?=Html::a($md->vdo_title,$md->vdo_url,['id' => $md->vdo_id,'target' => '_blank']); ?>
                                </h4>
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