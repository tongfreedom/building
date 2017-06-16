<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Department;
?>

<div class="team-search body">

    <!-- Start Form -->
    <?php 
        $form = ActiveForm::begin([
            'id' => 'form-search',
            'action' => ['index'],
            'method' => 'get',
            'options' => ['class' =>'form-horizontal'],
         ]); 
    ?>

    <!-- Fistname -->
    <?= $form->field($model, 'team_firstname',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>

    <!-- Lastname -->
    <?= $form->field($model, 'team_lastname',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

    <!-- Position -->
    <?= $form->field($model, 'team_position',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?>

    <!-- Department -->
    <?php  
        $items = ArrayHelper::map(Department::find()
            ->where(['=', 'active', 1])
            ->andWhere(['=', 'lan_id', 1])
            ->all(), 'dep_id', 'dep_name');

        echo $form->field($model, 'dep_id',[
            'template' => Yii::$app->params['template_select'],
            'labelOptions' => ['class' => ''],
        ])->dropdownList($items,['prompt' => '-- Department --']);
    ?>

    <!-- button -->
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
            $('#teamsearch-dep_id').selectpicker('deselectAll');
        });
    });
</script>
