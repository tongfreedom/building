<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use froala\froalaeditor\FroalaEditorWidget;

$assets = $this->theme->baseUrl.'/assets';
?>

<div class="contact-form body">

    <!-- Start Form -->
    <?php 
        $form = ActiveForm::begin([
            'options' => [
                'class' =>'form-horizontal',
                'enctype' => 'multipart/form-data'
            ],
        ]); 
    ?>

    <!-- language -->
    <?php
        // if (isset($_GET['lan_id'])) {
        //     $lanID = $_GET['lan_id'];
        // } else {
        //     $lanID = 1;
        // }
        // echo $form->field($model, 'lan_id')->hiddenInput([
        //     'value' => $lanID,
        // ])->label(false);

        // if (isset($_GET['parent_id'])) {
        //     $parentID = $_GET['parent_id'];
        // } else {
        //     $parentID = NULL;
        // }

        // echo $form->field($model, 'parent_id')->hiddenInput([
        //     'value' => $parentID,
        // ])->label(false);
    ?>

    <!-- Email -->
    <?= $form->field($model, 'foot_email',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'email']) ?>

    <!-- Tel -->
    <?= $form->field($model, 'foot_tel',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'tel']) ?>

    <!-- Map Url -->
    <?= $form->field($model, 'foot_map',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Map URL']) ?>

    <!-- Worktime -->
    <?= $form->field($model, 'foot_work',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textArea(['maxlength' => true, 'placeholder' => 'Worktime']) ?>

    <!-- Address -->
    <?= $form->field($model, 'foot_address',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textArea(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <!-- Detail -->
    <?= $form->field($model, 'foot_detail',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textArea(['maxlength' => true, 'placeholder' => 'Detail']) ?>

    <!-- Button -->
    <div class="row clearfix">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
            <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success m-t-15 waves-effect' : 'btn btn-primary m-t-15 waves-effect']) ?>
        </div>
    </div>

    <!-- Show Name Create Update -->
    <?php if(!$model->isNewRecord){ ?>
    <span style="float:right;color:#888;font-size:0.9em;">
        <span>Create by : <?=$model->profile->name.' '.$model->profile->lastname; ?></span>, 
        <span>Create : <?=Yii::$app->Formatter->asDate($model->create, 'php:d/m/Y'); ?></span>, 
        <span>Update : <?=Yii::$app->Formatter->asDate($model->update, 'php:d/m/Y'); ?></span> 
    </span>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    <!-- End Form -->
</div>
