<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
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
?>

<?= $form->field($profile, 'name',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) 
?>

<?= $form->field($profile, 'lastname',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) 
?>

<?= $form->field($profile, 'bio',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->textArea(['maxlength' => true, 'placeholder' => 'Detail']) 
?>

<div class="row clearfix m-t-10">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary m-t-15 waves-effect']) ?>
        <?= Html::resetButton('CLEAR', ['class' => 'btn btn-danger m-t-15 waves-effect']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
