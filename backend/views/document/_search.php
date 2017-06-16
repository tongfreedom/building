<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Type;
use backend\models\DocumentType;
use kartik\depdrop\DepDrop;
?>

<div class="document-search body">

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
    <?= $form->field($model, 'doc_title',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <!-- Type -->
    <?php  
        $items = ArrayHelper::map(Type::find()
            ->where(['=', 'active', 1])
            ->andWhere(['=', 'lan_id', 1])
            ->all(), 'type_id', 'type_name');
        
        echo $form->field($model, 'type_id',[
            'template' => Yii::$app->params['template_select'],
            'labelOptions' => ['class' => ''],
        ])->dropdownList($items,['prompt' => '-- Type --']);

        $items = [];

        if($model->type_id != ""){
            $items = ArrayHelper::map(DocumentType::find()
                ->where(['=', 'active', 1])
                ->andWhere(['=', 'lan_id', 1])
                ->andWhere(['=', 'type_id', $model->type_id])
                ->all(), 'doc_type_id', 'doc_type_name');
        }
    ?>

    <!-- Document Type -->
    <?= $form->field($model, 'doc_type_id',['template' => Yii::$app->params['template_select']])->widget(DepDrop::classname(), [
        'data'=> $items,
        'options' => ['placeholder' => '-- Document Type --'],
        'pluginOptions'=>[
            'depends'=>['documentsearch-type_id'],
            'placeholder'=>'-- Document Type --',
            'url'=>Url::to(['/document/get-doctype'])
        ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('#documentsearch-doc_type_id').selectpicker('refresh'); 
        }",
        ],
    ]); ?>

    <!-- Button -->
    <div class="row clearfix">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" style="text-align:left;">
            <?= Html::submitButton('SEARCH', ['class' => 'btn btn-primary m-t-15 waves-effect','onclick' => "return search()"]) ?>
            <?= Html::resetButton('CLEAR', ['class' => 'btn btn-default m-t-15 waves-effect','id' => 'btn-reset']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <!-- End Form -->
</div>

<!-- Script -->
<script>
    $(document).ready(function() {
        $('#btn-reset').click(function(event) {
            $('#documentsearch-type_id').selectpicker('deselectAll');
        });
    });
</script>