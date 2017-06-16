<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('lan','News').Yii::t('lan','Annouce & Tender');

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
                    <?=Html::a($this->title,['news/index','type_id' => $type->type_id]); ?>
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
            <div class="post-content post-thumbnail col-md-9">
                    
                <?php $tag_arr = []; ?>
                <?php foreach($model as $md): ?>
				
                <!-- Blog image post-->
                <div class="post-item">
                    <br>
					
					 <!-- Image -->
                    <div class="post-image" style="width:20% !important;">
                        <div class="effect social-links">
                           
                            <div class="image-box-content">
                                <p>
									 <?=Html::img($upload_path.'/news/thumb/'.$md->news_img,[
										'class' => 'ponsive img-responsive img-rounded',
										'alt' => $md->news_title,
										'title' => $md->news_title,
									]); ?>
                                </p>
                            </div>
                        </div>

                    </div>
                   
                    
                    <div class="post-content-details">
                        <!-- Title -->
                        <div class="post-title">
                            <h4>
                                <?=Html::a($md->news_title,['news/view','id' => $md->news_id],['class' => 'news_title']); ?>
                            </h4>
                        </div>

                        <!-- Info -->
                        <div class="post-info" style="color:#fe7300;">
                            <span class="post-autor"><?=Yii::t('lan','Post by');?> : <?=$md->profile->name; ?></span>
                            |
                            <span class="post-comments-number"><?=Yii::t('lan','Type');?> : <?=Yii::t('lan','Annouce & Tender'); ?></span>
                        </div>

                        <!-- Description -->
                        <div class="post-description">
                            <p style="text-indent: 2em;">
                                <?php
                                    echo Yii::$app->mhelpers->subdetail($md->news_detail,300);
                                ?>
                            </p>

                            <div class="post-read-more">
                                <?=Html::a(Yii::t('lan','view detail').' <i class="fa fa-long-arrow-right"></i>',['news/view','id' => $md->news_id],['class' => 'read-more']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="post-meta" style="width:80% !important;">
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
                            <span class="post-comments-number"><?=$md->news_view; ?></span>
                        </div>
                    </div>
                </div>
                <?php 
                    $tag = Yii::$app->mtag->gettag($md->tag_id);
                    array_push($tag_arr,$tag[0]);
                ?>
                <?php endforeach; ?>

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
            <!-- END: Blog post-->

            <!-- Sidebar-->
            <div class="sidebar sidebar-modern col-md-3">

                <!--widget tags -->
                <div class="widget clearfix widget-tags">
                    <h4 class="widget-title" style="color:#fe7300;">
                        <i class="fa fa-tag"></i> Tags
                    </h4>

                    <div class="tags">
                        <?php foreach ($tag_arr as $value) {
                            echo Html::a($value,'#');
                        } ?>
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
                                <?php 
                                    // $year = Yii::$app->Formatter->asDate($hit->create, 'php:Y');

                                    // if(Yii::$app->languages->id == 1){
                                    //     $year = $year+543;
                                    // }
                                    echo Yii::$app->Formatter->asDateTime($hit->create, 'php:d F Y');
                                ?>
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