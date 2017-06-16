<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Department
?>

<div class="project-search body">
    <?php $form = ActiveForm::begin([
        'id' => 'form-search',
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' =>'form-horizontal'],
     ]); ?>

    <?= $form->field($model, 'name',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'lastname',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

    <?= $form->field($model, 'email',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
        
     
        <div class="row clearfix">
            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" style="text-align:left;">
                <?= Html::submitButton('<i class="material-icons">search</i> SEARCH', ['class' => 'btn btn-primary m-t-15 waves-effect','onclick' => "return search()"]) ?>
                <?= Html::resetButton('<i class="material-icons">clear</i> CLEAR', ['class' => 'btn btn-default m-t-15 waves-effect']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
