<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('lan','FAQ');

$upload_path = Yii::$app->request->baseurl.'/upload';
$assets = $this->theme->baseUrl.'/assets';
?>

<!-- Title -->
<section id="page-title" class="background-dark text-light" style="background-image: url('<?=$assets; ?>/images/bg_title.jpg')">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><?=$type->type_name ?></h1>
            <span><?=Yii::t('lan','TGDE'); ?></span>
        </div>
        <div class="breadcrumb col-md-4">
            <ul>
                <li>
                    <?=Html::a('<i class="fa fa-home"></i>',['site/index']) ?>
                </li>
                <li class="active"  style="color:#fe7300 !important;">
                    <?=Html::a($this->title,['faq/index','type_id' => $type->type_id]); ?>
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
            <div class="post-content post-thumbnail col-md-12">
                <div class="hr-title hr-long center">
                    <abbr><?=Yii::t('lan','FAQ') ?></abbr>
                </div>

                <div class="row">
                    <?php foreach ($model as $md) : ?>

                    <h4><?=$md->faq_question; ?> <i class="fa fa-question-circle" style="color:#fe7300;"></i></h4>

                    <p>
                        <?=$md->faq_answer; ?>
                    </p>

                    <div class="seperator">
                        <i class="fa fa-book"></i>
                    </div>

                    <?php endforeach; ?>
                </div>

                <!--END: Default Seperator-->
                <hr class="space">

            </div>
            <!-- END: Blog post-->
        </div>
    </div>
</section>
<!-- END: SECTION -->
