<?php

use yii\helpers\Html;
use yii\widgets\Menu;

$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-header bg-blue" style="padding:10px;">
                <?= Html::img($user->profile->getAvatarUrl(24), [
                    'class' => 'img-rounded',
                    'alt' => $user->username,
                ]) ?>
                <span class="font-bold m-l-5"><?= $user->username ?></span>
            </div>
            <div class="panel-body">
                <div class="demo-button">
                    <?php  
                        if(Yii::$app->controller->action->id == "profile")
                        {
                            $class1 = "btn-primary";
                            $class2 = "btn-default";
                        }else{
                            $class1 = "btn-default";
                            $class2 = "btn-primary";
                        }
                    ?>
                    <?=Html::a(Yii::t('user', 'Profile Detail'),['/user/settings/profile'],['class' => 'btn btn-block btn-lg '.$class1.' waves-effect']); ?>
                    <?=Html::a(Yii::t('user', 'Account Detail'),['/user/settings/account'],['class' => 'btn btn-block btn-lg '.$class2.' waves-effect']); ?>
                </div>
            </div>
        </div>
    </div>
</div>