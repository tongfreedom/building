<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Department;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 */

$this->title = Yii::t('user', 'Setting Account');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'account-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>


                <?php 
                    $template = '<div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            {label}
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    {input}{error}
                                </div>
                            </div>
                        </div>
                    </div>';

                    $template_select = '<div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                {label}
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        {input}
                                    </div>
                                </div>
                            </div>
                        </div>';

                ?>
                <?= $form->field($model, 'email',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Email']) 
                ?>

                <?= $form->field($model, 'username',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Username']) 
                ?>

                <?= $form->field($model, 'new_password',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->passwordInput() 
                ?>
                <hr/>

                <?= $form->field($model, 'current_password',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->passwordInput()
                ?>

                <div class="row clearfix m-t-10">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary m-t-15 waves-effect']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <?php if ($model->module->enableAccountDelete): ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('user', 'Delete account') ?></h3>
                </div>
                <div class="panel-body">
                    <p>
                        <?= Yii::t('user', 'Once you delete your account, there is no going back') ?>.
                        <?= Yii::t('user', 'It will be deleted forever') ?>.
                        <?= Yii::t('user', 'Please be certain') ?>.
                    </p>
                    <?= Html::a(Yii::t('user', 'Delete account'), ['delete'], [
                        'class' => 'btn btn-danger',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure? There is no going back'),
                    ]) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
