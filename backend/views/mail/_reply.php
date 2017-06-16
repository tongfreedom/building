<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use froala\froalaeditor\FroalaEditorWidget;
use kartik\file\FileInput;
?>

<div class="reply-form body">
    <!-- Start Form -->
    <?php 
        $form = ActiveForm::begin([
            'id' => 'form-search',
            'action' => ['mail/view','id' => $model->mail_id],
            'method' => 'post',
            'options' => ['class' =>'form-horizontal'],
        ]);
    ?>
    
    <!-- Mail ID -->
    <?php  
        echo $form->field($reply, 'mail_id')->hiddenInput([
            'value' => $model->mail_id,
        ])->label(false);

        $reply->reply_email = $model->mail_email;
    ?>

    <!-- Email -->
    <?= $form->field($reply, 'reply_email',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
    
    <!-- Subject -->
    <?= $form->field($reply, 'reply_subject',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'subject']) ?>
    
    <!-- Detail -->
    <div class="form-group field-reply-reply_detail">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="">Detail</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <?php echo FroalaEditorWidget::widget([
                            'model' => $reply,
                            'attribute' => 'reply_details',
                            'options'=>[
                                'id'=>'content',
                            ],
                            'clientOptions'=>[
                                'toolbarInline'=> false,
                                'theme' =>'royal',
                                'language'=>'en_us',
                                'height'=> 300,
                                'imageUploadURL' => url::to(['uploadfroala/uploadimage']),
                                'fileUploadURL' =>  url::to(['uploadfroala/uploadfile']),
                                'videoUploadURL' =>  url::to(['uploadfroala/uploadvideo']),
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="row clearfix">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" style="text-align:left;">
             <?= Html::submitButton('SEND MAIL', ['class' => 'btn btn-success m-t-15 waves-effect']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <!-- End Form -->
</div>
