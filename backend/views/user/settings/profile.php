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
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Setting Profile');
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
                    'id' => 'profile-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

                <!--  -->
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
                ?>

                <?= $form->field($model, 'name',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) 
                ?>

                <?= $form->field($model, 'lastname',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) 
                ?>

                <?= $form->field($model, 'bio',[
                            'template' => $template,
                            'labelOptions' => ['class' => ''],
                    ])->textArea(['maxlength' => true, 'placeholder' => 'Details']) 
                ?>

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
