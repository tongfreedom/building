<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Type;
use froala\froalaeditor\FroalaEditorWidget;
use kartik\file\FileInput;
use backend\models\Picture;

$assets = $this->theme->baseUrl.'/assets';
$this->registerCssFile($assets.'/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css');
?>

<div class="gallery-form body">
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
            $attr = ['prompt' => '-- Gallery Type --','disabled' => 'disabled'];
        }else{
            $attr = ['prompt' => '-- Gallery Type --'];
        }

        echo $form->field($model, 'type_id',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
            'errorOptions' => ['class' => 'help-block']
        ])->dropdownList($items,$attr); 
    ?>

    <!-- Title -->
    <?= $form->field($model, 'gall_title',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'title']) ?>

    <!-- Detail -->
    <div class="form-group field-gallery-gall_detail">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="">Detail</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <?php echo FroalaEditorWidget::widget([
                            'model' => $model,
                            'attribute' => 'gall_detail',
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

    <?php  
    if($lanID == 1){
    ?>

    <!-- Cover Image -->
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                <?php echo $model->getAttributeLabel('gall_img'); ?>
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php  
                        echo Yii::$app->mpic->picform($model,'gall_img','gallery','Gallery');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Picture -->
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                Images
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php
                        $gallTime = time();
                        echo Html::hiddenInput('gallTime',$gallTime);

                        $optionGall['uploadUrl'] = Url::to(['gallery/upload']);
                        $optionGall['uploadExtraData'] = ['gallTime' => $gallTime];
                        // If update is show image
                        if($model->gall_id != NULL){
                            $gallShow = Picture::findAll(['gall_id' => $model->gall_id,'active' => 1]);
                            if($gallShow != NULL){
                                $preview = [];
                                $previewConfig = [];
                                foreach ($gallShow as $gallShowItems) {
                                    array_push($preview, Yii::$app->request->baseurl."/../upload/gallery/".$gallShowItems->pic_img);
                                    array_push($previewConfig,['url' => url::to(['/gallery/deletegall','id' => $gallShowItems->pic_id])]);

                                }
                                $optionGall['initialPreview'] = $preview;
                                $optionGall['initialPreviewConfig'] = $previewConfig;
                                $optionGall['initialPreviewAsData'] = true;
                                $optionGall['overwriteInitial'] = false;

                            }
                        }
                        $optionGall['deleteUrl'] = Url::to(['gallery/deletegall']);
                        echo FileInput::widget([
                            'model' => $picture,
                            'attribute' => 'gall_file',
                            'options'=>['multiple'=>true],
                            'pluginOptions' => $optionGall,
                            'pluginLoading' => true,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
    
    <!-- Tag -->
    <?= $form->field($model, 'tag',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput([
        'maxlength' => true, 
        'placeholder' => 'tag',
        'data-role' => 'tagsinput',
        'value' => Yii::$app->mtag->tagshow($model->tag_id)
    ]) ?>

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

<?php  
    // Bootstrap Tags Input Plugin Js
    $this->registerJsFile($assets.'/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js');
?>