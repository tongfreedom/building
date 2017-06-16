<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = Yii::t('user', 'Create a user account');
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
                    <?=Html::a(Yii::t('user', 'Account details'),['/user/admin/create'],['class' => 'btn btn-block btn-lg btn-primary waves-effect']); ?>
                    <?=Html::a(Yii::t('user', 'Profile details'),['/user/admin/create'],['class' => 'btn btn-block btn-lg btn-default waves-effect disabled',
                            'onclick' => 'return false;']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="alert alert-info">
                    <?= Yii::t('user', 'Credentials will be sent to the user by email') ?>.
                    <?= Yii::t('user', 'A password will be generated automatically if not provided') ?>.
                </div>
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-9',
                        ],
                    ],
                ]); ?>
                <?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>


                <div class="row clearfix m-t-10">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary m-t-15 waves-effect']) ?>
                        <?= Html::resetButton('CLEAR', ['class' => 'btn btn-danger m-t-15 waves-effect']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
