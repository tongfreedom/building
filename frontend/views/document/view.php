<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use frontend\models\Document;
use frontend\models\DocumentType;

$this->title = Yii::t('lan','Document').$type->type_name;

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
                    <?=Html::a($this->title,['document/index','type_id' => $type->type_id]); ?>
                </li>
            </ul>
        </div>
    </div>
</section>


<!-- CONTENT -->
<section class="content p-t-50 p-b-0" style="background-color: #fff;">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar-->
            <div class="sidebar sidebar-modern col-md-3">
                <!--widget archive-->
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title"><?=Yii::t('lan','Document Type'); ?></h4>
                    <ul class="list list-lines">
                        <li>
                            <?=Html::a('<i class="fa fa-file-text-o"></i> '.Yii::t('lan', 'Document All'),['document/index','type_id' => $type->type_id]); ?>
                        </li>
                        <?php foreach ($doc_type as $dt) : ?>
                        <li>
                            <?php  
                                $style = [];
                                if($doc_type_id == $dt->doc_type_id){
                                    $style = ['style' => 'color:#fe7300;'];

                                }
                            ?>
                            <?=Html::a('<i class="fa fa-file-text-o"></i> '.$dt->doc_type_name,['document/index','type_id' => $type->type_id,'doc_type_id' => $dt->doc_type_id],$style); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--end: widget archive-->
            </div>
            <!-- END: Sidebar-->

            <!-- Blog post-->
            <div class="post-content float-right post-modern post-content-single col-md-9">
                <?php $doctype = DocumentType::find()->where(['doc_type_id'=>$doc_type_id])->one(); ?>
                <h4><i class="fa fa-file-text-o"></i> <?=$doctype->doc_type_name; ?></h4>
                    <ul style="list-style-type: none;">
                    <?php
                        foreach ($model as $md) {
                            echo '<li style="margin-bottom:8px;"><i class="fa fa-file-o"></i> '.Html::a($md->doc_title,Yii::$app->request->baseUrl.'/upload/document/'.$md->doc_url,['target' => '_blank']).'</li>';
                        }
                    ?>
                    </ul>
                <div class="seperator"><i class="fa fa-cloud-download"></i></div>
            </div>
            <!-- END: Blog post-->

        </div>
    </div>
</section>
<!-- END: SECTION -->
