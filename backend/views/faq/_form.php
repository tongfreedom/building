<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Type;
use yii\helpers\ArrayHelper;
use froala\froalaeditor\FroalaEditorWidget;

?>

<div class="faq-form body">
    
    <!-- Start Form -->
    <?php 
        $form = ActiveForm::begin([
            'options' => [
                'class' =>'form-horizontal',
                'enctype' => 'multipart/form-data'
            ],
        ]); 
    ?>

    <!-- Language -->
    <?php
        if (isset($_GET['lan_id'])) {
            $lanID = $_GET['lan_id'];
        } else {
            $lanID = 1;
        }
        echo $form->field($model, 'lan_id')->hiddenInput([
            'value' => $lanID,
        ])->label(false);

        if (isset($_GET['parent_id'])) {
            $parentID = $_GET['parent_id'];
        } else {
            $parentID = NULL;
        }

        echo $form->field($model, 'parent_id')->hiddenInput([
            'value' => $parentID,
        ])->label(false);

    ?>

    <!-- Type -->
    <?php
        $items = ArrayHelper::map(Type::find()
            ->where(['=', 'active', 1])
            ->andWhere(['=', 'lan_id', $lanID])
            ->all(), 'type_id', 'type_name');

        if($lanID != 1){
            $attr = ['prompt' => '-- FAQ Type --','disabled' => 'disabled'];
        }else{
            $attr = ['prompt' => '-- FAQ Type --'];
        }
        
        echo $form->field($model, 'type_id',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->dropdownList($items,$attr);
    ?>
        
    <!-- Question -->
    <?= $form->field($model, 'faq_question',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'question']) ?>

    <!-- Answer -->
    <div class="form-group field-faq-faq_answer">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="">Answer</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <?php echo FroalaEditorWidget::widget([
                            'model' => $model,
                            'attribute' => 'faq_answer',
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