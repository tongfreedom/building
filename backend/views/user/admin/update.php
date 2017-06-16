<?php

use dektrium\user\models\User;
use yii\bootstrap\Nav;
use yii\web\View;
use yii\helpers\Html;

$this->title = Yii::t('user', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]) ?>


<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="demo-button">
                    <?=Html::a(Yii::t('user', 'Account details'),['/user/admin/update', 'id' => $user->id],['class' => 'btn btn-block btn-lg btn-primary waves-effect']); ?>
                    <?=Html::a(Yii::t('user', 'Profile details'),['/user/admin/update-profile', 'id' => $user->id],['class' => 'btn btn-block btn-lg btn-default waves-effect']); ?>
                    <hr>

                    <?=Html::a(Yii::t('user', 'Delete'),['/user/admin/delete', 'id' => $user->id],[
                        'class' => 'btn btn-block btn-lg btn-danger waves-effect', 
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure you want to delete this user?')
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
