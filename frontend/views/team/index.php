<?php
use yii\helpers\Html;
use frontend\models\Team;
use frontend\models\Department;

$this->title = Yii::t('lan','Team');

$assets = $this->theme->baseUrl.'/assets';
$upload_path = Yii::$app->request->baseurl.'/upload';
?>

<!-- Title -->
<section id="page-title" class="background-dark text-light">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><i class="fa fa-user"></i> <?=$this->title ?></h1>
            <span><?=Yii::t('lan','TGDE'); ?></span>
        </div>
        <div class="breadcrumb col-md-4">
            <ul>
                <li>
                    <?=Html::a('<i class="fa fa-home"></i>',['site/index']) ?>
                </li>
                <li class="active">
                    <?=Html::a($this->title,'#'); ?>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Content -->
<section class="p-t-20 p-b-20">
    <div class="container p-l-0 p-r-0">
        <div class="row">
            <div class="col-md-12">

                <!-- Department -->
                <div class="accordion fancy radius color">
                    <?php
                        $i_dep = 1;
                        foreach ($department as $dep) { 
                            // First active
                            $class = ($i_dep == 1) ? 'ac-item active ac-active' : 'ac-item';
                    ?>

                        <div class="<?=$class; ?>">
                            <h4 class="ac-title">
                                <i class="fa fa-user"></i>
                                <?=$dep->dep_name; ?>
                            </h4>
                            <div class="ac-content">
                                    <!-- Team -->
                                    <?php  
                                        $i = 1;
                                        foreach ($model[$dep->dep_id] as $md) {
                                        if($i%4 == 0){
                                            echo "<div class='row'>";
                                        }
                                    ?>

                                    <?php 
                                        $class = 'col-md-3';
                                        if(($i==1) && ($i_dep==1)){
                                            $class = 'col-md-offset-4 col-md-4 text-center';
                                        }
                                        if(($i==2) && ($i_dep==1)){
                                            $class = 'col-md-offset-3 col-md-3';
                                        }
                                    ?>
                                    <div class="<?=$class; ?>">
                                        <div class="">
                                            <?=Html::img($upload_path.'/team/thumb/'.$md->team_img,[
                                                'class' => 'img-thumbnail img-rounded img-responsive ',
                                                'alt' => $md->team_firstname,
                                                'title' => $md->team_firstname,
                                            ]); ?>

                                        </div>
                                        <div class="image-box-description">
                                            <h4><?=$md->fullname($md); ?></h4>
                                            <p class="subtitle">
                                                <?=$md->team_position; ?>
                                                <br>
                                                <?=$md->team_level; ?>
                                            </p>
                                            <hr class="line">
                                            <div class="social-icons social-icons-border m-t-10">
                                                <ul>
                                                    <li class="social-facebook" style="float:none;display:inline;margin-left:5px;">
                                                        <a 
                                                            class="pointer"
                                                            <?php if(($i==1) && ($i_dep==1)){echo 'style="float:none;padding-right:5px;padding-left:10px;padding-top:5px;padding-bottom:5px;"'; }?>
                                                            onclick="freedom()" 
                                                           data-toggle="popover" 
                                                            data-placement="top"
                                                            title="" 
                                                            data-original-title="<i class='fa fa-phone'></i> <?=$md->team_tel; ?>">
                                                            <i class="fa fa-phone"></i>
                                                        </a>

                                                    </li>
                                                    <li class="social-twitter" style="float:none;display:inline;">
                                                        <a 
                                                            class="pointer"
                                                            <?php if(($i==1) && ($i_dep==1)){echo 'style="float:none;padding-right:10px;padding-left:10px;padding-top:5px;padding-bottom:5px;"'; }?>
                                                            data-toggle="popover" 
                                                            data-placement="top"
                                                            title="" 
                                                            data-original-title="<?=$md->team_email; ?>">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(($i==1) && ($i_dep==1)){ ?>
                                    <div class="clearfix"></div>
                                    <?php } ?>
                                    <?php 
                                            if($i%4 == 0){
                                                echo "</div>";
                                            }
                                            $i++;
                                        } 
                                    ?>
                            </div>
                        </div>
                    <?php
                            $i_dep++;
                        }
                    ?>
                </div>
                <hr class="space">

            </div>
    </div>
</section>