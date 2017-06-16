<?php
use yii\helpers\Html;
use frontend\models\Footer;
use frontend\models\Link;
use frontend\models\About;
use frontend\models\Services;

$this->title = Yii::t('lan','TGDE');

$assets = $this->theme->baseUrl.'/assets';
$upload_path = Yii::$app->request->baseurl.'/upload';
?>

<!-- HOT NEWS -->
<section class="p-t-20 p-b-20">
    <div class="container p-l-0 p-r-0">
        <div class="grid-articles">
            <?php  
                foreach ($hot as $ht) {
            ?>
                <article class="post-entry product">
                    <div class="product-image">
                        <a href="#">
                            <?=Html::img($upload_path.'/news/thumb/'.$ht->news_img,[
                                'class' => 'img-hot-news',
                                'title' => $ht->news_title,
                                'alt' => $ht->news_title
                            ]); ?>
                        </a>
                        <span class="product-new">
                            <?=$ht->type->type_name; ?>
                        </span>
                        <div class="product-overlay">
                            <?=Html::a($ht->news_title,['news/view','id' => $ht->news_id],[
                                'data-lightbox-type' => 'url'
                            ]); ?>
                        </div>
                    </div>
                </article>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<!-- END: HOT NEWS -->

<!-- TAB AND PORTFOLIO -->
<section class="p-t-0 p-b-20">
    <div class="container p-l-0 p-r-0">
        <div class="row">
            <!-- Left -->
            <div class="col-md-9">
                <!--Horizontal tabs border -->
                <div id="tabs-05" class="tabs border justified">
                    <!-- Tab navigation -->
                    <ul class="tabs-navigation">
                        <li class="active">
                            <a href="#news"><i class="fa fa-newspaper-o"></i>
                                <?=Yii::t('lan','Promote News'); ?>
                            </a>
                        </li>
						<li>
                            <a href="#price"><i class="fa fa-bullhorn"></i>
                                <?=Yii::t('lan','Annouce & Tender'); ?>
                            </a> 
                        </li>
                        <li>
                            <a href="#article"><i class="fa fa-list-ul"></i>
                                <?=Yii::t('lan','Article'); ?>
                            </a> 
                        </li>
                        <li>
                            <a href="#gallery"><i class="fa fa-image"></i>
                                รูปภาพ
                            </a> 
                        </li>
                        <li>
                            <a href="#video"><i class="fa fa-video-camera"></i>
                                วีดีโอ
                            </a> 
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tabs-content" >
                        <!-- News -->
                        <div class="tab-pane active" id="news">
                            <div class="row">
                                <?php  
                                    $i = 1;
                                    foreach ($news as $nw) {
                                        if(($i == 1) || ($i == 5))
                                            echo '<div class="col-md-6"><div class="post-thumbnail-list">';
                                        
                                ?>
                                        <div class="post-thumbnail-entry">
                                            <?=Html::img($upload_path.'/news/thumb/'.$nw->news_img,[
                                                'title' => $nw->news_title,
                                                'alt' => $nw->news_title,
                                                'class' => 'img-responsive img-rounded'
                                            ]); ?>
                                            <div class="post-thumbnail-content">
                                                <h4>
                                                    <?=Html::a($nw->news_title,['news/view',
                                                        'id'=>$nw->news_id
                                                    ]); ?>
                                                </h4>
                                                <span class="post-date"><i class="fa fa-clock-o"></i> 
                                                    <?=Yii::$app->Formatter->asDate($nw->create,'medium'); ?>
                                                </span>
                                                <span class="post-category">
                                                    <i class="fa fa-tag"></i>
                                                    <?=Html::a($nw->type->type_name,['news/type',
                                                        'id' => $nw->type_id
                                                    ],['style' => 'color:#fe3700;']); ?>
                                                </span>
                                            </div>
                                        </div>
                                <?php
                                        if($i == 4)
                                            echo '</div></div>';
                                            
                                        $i++;
                                    }

                                    if(($i != 5) && ($i != 1)){
                                        echo '</div></div>';
                                    }
                                ?>
                            </div>
                        </div>
						
						<!-- News -->
                        <div class="tab-pane" id="price">
                            <div class="row">
                                <?php  
                                    $i = 1;
                                    foreach ($price as $pc) {
                                        if(($i == 1) || ($i == 5))
                                            echo '<div class="col-md-6"><div class="post-thumbnail-list">';
                                        
                                ?>
                                        <div class="post-thumbnail-entry">
                                            <?=Html::img($upload_path.'/news/thumb/'.$pc->news_img,[
                                                'title' => $pc->news_title,
                                                'alt' => $pc->news_title,
                                                'class' => 'img-responsive img-rounded'
                                            ]); ?>
                                            <div class="post-thumbnail-content">
                                                <h4>
                                                    <?=Html::a($pc->news_title,['news/view',
                                                        'id'=>$pc->news_id
                                                    ]); ?>
                                                </h4>
                                                <span class="post-date"><i class="fa fa-clock-o"></i> 
                                                    <?=Yii::$app->Formatter->asDate($pc->create,'medium'); ?>
                                                </span>
                                                <span class="post-category">
                                                    <i class="fa fa-tag"></i>
                                                    <?=Html::a(Yii::t('lan','Annouce & Tender'),['news/newsprice'],['style' => 'color:#fe3700;']); ?>
                                                </span>
                                            </div>
                                        </div>
                                <?php
                                        if($i == 4)
                                            echo '</div></div>';
                                            
                                        $i++;
                                    }

                                    if(($i != 5) && ($i != 1)){
                                        echo '</div></div>';
                                    }
                                ?>
                            </div>
							
							 <span style="float:right;margin-top: 15px;">
                                <?=Html::a('<i class="fa fa-arrow-right"></i> '.Yii::t('lan', 'View Annouce & Tender All'),['news/newsprice']); ?>
                            </span>
                        </div>

                        <!-- Article -->
                        <div class="tab-pane" id="article">
                            <div class="row">
                                <?php  
                                    $i = 1;
                                    foreach ($article as $art) {
                                        if(($i == 1) || ($i == 5))
                                            echo '<div class="col-md-6"><div class="post-thumbnail-list">';
                                        
                                ?>
                                        <div class="post-thumbnail-entry">
                                            <?=Html::img($upload_path.'/article/thumb/'.$art->art_img,[
                                                'title' => $art->art_title,
                                                'alt' => $art->art_title,
                                                'class' => 'img-responsive img-rounded'
                                            ]); ?>
                                            <div class="post-thumbnail-content">
                                                <h4>
                                                    <?=Html::a($art->art_title,['article/view',
                                                        'id'=>$art->art_id
                                                    ]); ?>
                                                </h4>
                                                <span class="post-date"><i class="fa fa-clock-o"></i> 
                                                    <?=Yii::$app->Formatter->asDate($art->create,'medium'); ?>   
                                                </span>
                                                <span class="post-category">
                                                    <i class="fa fa-tag"></i>
                                                    <?=Html::a($art->type->type_name,['article/type',
                                                        'id' => $art->type_id
                                                    ],['style' => 'color:#fe3700;']); ?>
                                                </span>
                                            </div>
                                        </div>
                                <?php
                                        if($i == 4)
                                            echo '</div></div>';
                                            
                                        $i++;
                                    }

                                    if(($i != 5) && ($i != 1)){
                                        echo '</div></div>';
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div class="tab-pane" id="gallery">

                            <?php  
                                $i = 1;
                                foreach ($gallery as $gall) {
                                    if(($i == 1) || ($i == 4))
                                        echo '<div class="row">';
                                    
                            ?>
                                    <div class="col-md-4">
                                        <div class="effect social-links">
                                            <?=Html::img($upload_path.'/gallery/thumb/'.$gall->gall_img,[
                                                'class' => 'img-responsive img-thumbnail',
                                                'alt' => $gall->gall_title,
                                                'title' => $gall->gall_title,
                                            ]); ?>
                                            <div class="title-overlay">
                                                <?=Html::a($gall->gall_title,['gallery/view','id' => $gall->gall_id]); ?>
                                            </div>
                                            <div class="image-box-content">
                                                <p>
                                                    <?=Html::a('<i class="fa fa-picture-o"></i>',['gallery/view','id' => $gall->gall_id],[
                                                        'alt' => $gall->gall_title,
                                                        'title' => $gall->gall_title,
                                                    ]); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    if($i == 3)
                                        echo '</div><br>';
                                        
                                    $i++;
                                }

                                if(($i != 4) && ($i != 1)){
                                    echo '</div>';
                                }
                            ?>
                            <span style="float:right;margin-top: 15px;">
                                <?=Html::a('<i class="fa fa-arrow-right"></i> '.Yii::t('lan', 'View Gallery All'),['gallery/index']); ?>
                            </span>
                        </div>

                        <!-- Video -->
                        <div class="tab-pane" id="video">
                            <?php  
                                $i = 1;
                                foreach ($video as $vdo) {
                                    if(($i == 1) || ($i == 4))
                                        echo '<div class="row">';
                                    
                            ?>
                                    <div class="col-md-4">
                                        <div class="effect social-links">
                                            <?=Html::img($upload_path.'/video/thumb/'.$vdo->vdo_img,[
                                                'alt' => $vdo->vdo_title,
                                                'title' => $vdo->vdo_title,
                                                'class' => 'img-responsive img-thumbnail'
                                            ]); ?>
                                            <div class="title-overlay">
                                                <?=Html::a($vdo->vdo_title,$vdo->vdo_url,['target' => '_blank']); ?>
                                            </div>
                                            <div class="image-box-content">
                                             <p>
                                                <?=Html::a('<i class="fa fa-play"></i>',$vdo->vdo_url,['data-lightbox-type' => 'iframe']); ?>
                                             </p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    if($i == 3)
                                        echo '</div><br>';
                                        
                                    $i++;
                                }

                                if(($i != 4) && ($i != 1)){
                                    echo '</div>';
                                }
                            ?>
                            <span style="float:right;margin-top: 15px;">
                                <?=Html::a('<i class="fa fa-arrow-right"></i> '.Yii::t('lan', 'View Video All'),['vdo/index']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <!--END: Horizontal tabs border -->
            </div>
            <!-- End Left -->

            <!-- Right -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body p-t-0 p-b-0">
                        <div class="row">
                            <a href="http://www.tgde.kmutnb.ac.th/trainer/" target="_blank"><img src="<?=$assets; ?>/images/trainer.jpg" class="img-responsive img-rounded" alt="โครงการพัฒนาครูฝึกช่างเทคนิคขั้นสูงตามแนวทางมาตรฐานเยอรมัน" title="โครงการพัฒนาครูฝึกช่างเทคนิคขั้นสูงตามแนวทางมาตรฐานเยอรมัน"></a>
                        </div>
                    </div>
                </div>  

                <div class="panel panel-default">
                    <div class="panel-heading" id="header-portfolio">
                        <h3 class="panel-title"><i class="fa fa-graduation-cap"></i> 
                            <?=Yii::t('lan', 'Portfolio') ?>
                        </h3>
                    </div>
                    <div class="panel-body p-t-0">
                        <div class="row">
                            <div class="col-md-12 p-r-0 p-l-0">
                                <!--Post Carousel -->
                                <div class="grid-articles carousel post-carousel" data-carousel-col="1" data-carousel-margins="0">

                                    <?php  
                                        $i = 1;
                                        foreach ($work as $wk) {
                                    ?>
                                        <article class="post-entry product">
                                            <a href="#" class="post-image">
                                                <?=Html::img($upload_path.'/work/thumb/'.$wk->work_img,[
                                                    'alt'=>$wk->work_title,
                                                    'title'=>$wk->work_title,
                                                ]); ?>
                                            </a>
                                            <div class="post-entry-overlay product-overlay">
                                                <?=Html::a($wk->work_title,['work/view','id'=>$wk->work_id],['data-lightbox-type'=> 'url']); ?>
                                            </div>
                                        </article>
                                    <?php
                                        if($i == 3)
                                            break;
                                        $i++;
                                        }
                                    ?>
                                </div>
                                <!--END: Post Carousel -->
                            </div>
                        </div>

                       <!--  <div class="row">
                            <?php  
                                $i=1;
                                foreach ($work as $wk) {
                                    if(($i == 4) || ($i == 5)){
                                ?>
                                    <div class="col-md-6 padding-5">
                                        <?=Html::img($upload_path.'/work/thumb/'.$wk->work_img,[
                                            'class' => 'img-responsive img-thumbnail',
                                            'title' => $wk->work_title,
                                            'alt' => $wk->work_title,
                                        ]); ?>
                                        <div class="text-center">
                                            <?=Html::a($wk->work_title,['work/view','id' => $wk->work_id]); ?>
                                        </div>
                                    </div>
                                <?php
                                    }
                                    $i++;
                                }
                            ?>
                        </div> -->
                    </div>
                </div>  
            </div>
            <!-- End Right -->
    </div>
</section>
<!-- END: TAB AND PORTFOLIO -->

<!-- COMPANY -->
<section class="p-t-20 p-b-20" id="company">
    <div class="container p-l-0 p-r-0">
        <div class="hr-title hr-long center">
            <abbr><?=Yii::t('lan','Company Joined'); ?></abbr> 
        </div>
        
        <div class="grid-articles carousel post-carousel" data-carousel-col="6">
            <?php  
                foreach ($company as $com) {
            ?>
                <article class="post-entry">
                    <div class="effect social-links">
                        <?=Html::img($upload_path.'/company/thumb/'.$com->com_img,[
                            'class' => 'img-responsive img-thumbnail',
                            'title' => $com->com_name,
                            'alt' => $com->com_name
                        ]); ?>
                        <div class="image-box-content">
                            <p>
                                <?=Html::a('<i class="fa fa-link"></i>',$com->com_url,[
                                    'title' => $com->com_name,
                                    'alt' => $com->com_name,
                                    'target' => '_blank',
                                ]); ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<!-- END: COMPANY -->