<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="company-search body">
    <!-- Start Form -->
    <?php 
        $form = ActiveForm::begin([
            'id' => 'form-search',
            'action' => ['index'],
            'method' => 'get',
            'options' => ['class' =>'form-horizontal'],
         ]); 
    ?>
      
    <!-- Title -->
    <?= $form->field($model, 'com_name',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <!-- Button -->
    <div class="row clearfix">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" style="text-align:left;">
            <?= Html::submitButton('SEARCH', ['class' => 'btn btn-primary m-t-15 waves-effect','onclick' => "return search()"]) ?>
            <?= Html::resetButton('CLEAR', ['class' => 'btn btn-default m-t-15 waves-effect', 'id' => 'btn-reset']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <!-- End Form -->
</div>