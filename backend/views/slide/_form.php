<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$assets = $this->theme->baseUrl.'/assets';
$this->registerCssFile($assets.'/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css');
?>

<div class="slide-form body">
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
    
    <!-- Title -->
    <?= $form->field($model, 'slide_title',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'title']) ?>
    
    <?php if($lanID == 1){ ?>

    <!-- Slide Type -->
    <?php
        $items = ['1' => 'Image', '2' => 'Video'];
        $attr = ['prompt' => '-- Slide Type --'];
        
        echo $form->field($model, 'slide_type',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
            'errorOptions' => ['class' => 'help-block']
        ])->dropdownList($items,$attr); 
    ?>

    <!-- Cover Image -->
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                <?php echo $model->getAttributeLabel('slide_img'); ?>
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php  
                        echo Yii::$app->mpic->picform($model,'slide_img','slide','Slide');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Video -->
    <div class="row clearfix" id="div-slide-video" style="display:none;">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                <?php echo $model->getAttributeLabel('slide_vdo'); ?>
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php  
                        echo Yii::$app->mpic->picform($model,'slide_vdo','slide','Slide',2);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>

    <!-- Link -->
    <?= $form->field($model, 'slide_link',[
        'template' => Yii::$app->params['template'],
        'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'link']) ?>

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

<!-- Script -->
<script>
    $(document).ready(function() {
        var type = $('#slide-slide_type').val();

        if(type == 2){
            $('#div-slide-video').show();
        }

        $("#slide-slide_type").change(function(event) {
            var type = $(this).val();
            if(type == 2){
                $('#div-slide-video').show();
            }else{
                $('#div-slide-video').hide();
            }
        });
    });
</script>