<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Type;
use backend\models\DocumentType;
use kartik\file\FileInput;
use kartik\depdrop\DepDrop;

$assets = $this->theme->baseUrl.'/assets';
$this->registerCssFile($assets.'/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css');
?>

<div class="document-form body">
    
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
            $attr = ['prompt' => '-- Type --','disabled' => 'disabled'];
        }else{
            $attr = ['prompt' => '-- Type --'];
        }

        echo $form->field($model, 'type_id',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->dropdownList($items,$attr);
    ?>

    <!-- Document Type -->
    <?php
        $items = [];
        if($model->type_id != ""){
            $items = ArrayHelper::map(DocumentType::find()
                ->where(['=', 'active', 1])
                ->andWhere(['=', 'lan_id', $lanID])
                ->andWhere(['=', 'type_id', $model->type_id])
                ->all(), 'doc_type_id', 'doc_type_name');
        }

        if($lanID != 1){
            $attr = ['placeholder' => '-- Document Type --','disabled' => 'disabled'];
        }else{
            $attr = ['placeholder' => '-- Document Type --'];
        }

        echo $form->field($model, 'doc_type_id',['template' => Yii::$app->params['template']])->widget(DepDrop::classname(), [
            'options'=>['id'=>'document-doc_type_id'],
            'data'=> $items,
            'options' => $attr,
            'pluginOptions'=>[
                'depends'=>['document-type_id'],
                'placeholder'=>'-- Document Type --',
                'url'=>Url::to(['/document/get-doctype'])
            ],
            'pluginEvents' => [
                "depdrop.afterChange"=>"function(event, id, value) { $('#document-doc_type_id').selectpicker('refresh'); }",
            ],
        ]);
    ?>
      
    <!-- Title -->
    <?= $form->field($model, 'doc_title',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'title']) ?>
    
    <?php if($lanID == 1){  ?>

    <!-- URL -->
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                <?php echo $model->getAttributeLabel('doc_url'); ?>
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php  
                        echo Yii::$app->mdoc->docform($model,'doc_url','document','Document');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>

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