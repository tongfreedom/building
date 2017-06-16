<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('lan','Contact');

$upload_path = Yii::$app->request->baseurl.'/upload';
$assets = $this->theme->baseUrl.'/assets';
?>

<!-- Title -->
<section id="page-title" class="background-dark text-light" style="background-image: url('<?=$assets; ?>/images/bg_title.jpg')">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><?=$this->title ?></h1>
            <span><?=Yii::t('lan','TGDE'); ?></span>
        </div>
        <div class="breadcrumb col-md-4">
            <ul>
                <li>
                    <?=Html::a('<i class="fa fa-home"></i>',['site/index']) ?>
                </li>
                <li class="active"  style="color:#fe7300 !important;">
                    <?=Html::a($this->title,['contact/index']); ?>
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
                <div class="col-md-6">
                    <h3 class="text-uppercase" style="color:#fe7300;">
                        <?=Yii::t('lan','Email Message') ?>
                    </h3>
                    
                    <?=$model->foot_detail; ?> 

                    <div class="m-t-30">
                        <form id="widget-contact-form" action="mail" role="form" method="post">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="name"><?=Yii::t('lan','Name'); ?></label>
                                    <input type="text" aria-required="true" name="widget-contact-form-name" class="form-control required name" placeholder="<?=Yii::t('lan','Enter Your Name'); ?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email"><?=Yii::t('lan','Email'); ?></label>
                                    <input type="email" aria-required="true" name="widget-contact-form-email" class="form-control required email" placeholder="<?=Yii::t('lan','Enter Your Email'); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="subject"><?=Yii::t('lan','Subject'); ?></label>
                                    <input type="text" name="widget-contact-form-subject" class="form-control required" placeholder="<?=Yii::t('lan','Enter Subject....'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message"><?=Yii::t('lan','Message'); ?></label>
                                <textarea type="text" name="widget-contact-form-message" rows="5" class="form-control required" placeholder="<?=Yii::t('lan','Enter Message....'); ?>"></textarea>
                            </div>
                            <input type="text" class="hidden" id="widget-contact-form-antispam" name="widget-contact-form-antispam" value="" />
                            <button class="btn" type="submit" id="form-submit" style="background-color: #fe7300;color:#fff;"><i class="fa fa-paper-plane"></i>&nbsp;<?=Yii::t('lan','Send message'); ?></button>
                        </form>
                        <script type="text/javascript">
                            jQuery("#widget-contact-form").validate({

                                submitHandler: function(form) {

                                    jQuery(form).ajaxSubmit({
                                        success: function(text) {
                                            if (text == 'success') {
                                                $.notify({
                                                    message: "<?=Yii::t('lan','We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.'); ?>"
                                                }, {
                                                    type: 'success'
                                                });
                                                $(form)[0].reset();

                                            } else {
                                                $.notify({
                                                    message: "Error!"
                                                }, {
                                                    type: 'danger'
                                                });
                                            }
                                        }
                                    });
                                }
                            });

                        </script>
                    </div>
            </div>

            <div class="col-md-6">
                <h3 class="text-uppercase" style="color:#fe7300;">
                    <?=Yii::t('lan','Address & Map'); ?>
                </h3>

                <div class="row">
                    <div class="col-md-12">
                        <address>
                            <strong >
                                <?=Yii::t('lan','TGDE'); ?>
                            </strong>
                            <br>

                            <i class="fa fa-map-marker" style="margin-top: 10px;margin-bottom: 10px;"></i> 
                            <?=Yii::t('lan','Address'); ?> : <?=$model->foot_address; ?>
                            <br>

                            <i class="fa fa-phone" style="margin-bottom: 10px;"></i> 
                            <?=Yii::t('lan','Phone'); ?> : <?=$model->foot_tel; ?>
                            <br>
                            
                            <i class="fa fa-envelope" style="margin-bottom: 10px;"></i> 
                            <?=Yii::t('lan','Email'); ?> : <?=$model->foot_email; ?>
                            <br>
                              
                            <i class="fa fa-clock-o" style="margin-bottom: 10px;"></i> 
                            <?=Yii::t('lan','Work Time'); ?> : <?=$model->foot_work; ?>
                            <br>
                        </address>
                    </div>
                </div>

                <!-- Google map sensor -->
                <div class="row">
                    <div class="col-md-12">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1h4w1LE1X1iEerPCbPcmdUVQ6cMQ" width="100%" height="400px;">
                    </iframe>
                    </div>
                </div>
                <!--  <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
                <div class="map m-t-30" data-map-address="Melburne, Australia" data-map-zoom="10" data-map-icon="images/markers/marker2.png" data-map-type="ROADMAP"></div> -->
                <!-- Google map sensor -->

            </div>

            </div>
            <!-- END: Blog post-->
        </div>
    </div>
</section>
<!-- END: SECTION -->
