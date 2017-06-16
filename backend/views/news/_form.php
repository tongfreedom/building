<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use froala\froalaeditor\FroalaEditorWidget;
use yii\helpers\ArrayHelper;
use backend\models\Type;
use kartik\file\FileInput;

$assets = $this->theme->baseUrl.'/assets';
$this->registerCssFile($assets.'/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css');
?>

<div class="news-form body">
    
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
            $attr = ['prompt' => '-- News Type --','disabled' => 'disabled'];
        }else{
            $attr = ['prompt' => '-- News Type --'];
        }

        echo $form->field($model, 'type_id',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->dropdownList($items,$attr);
	?>

	<!-- new price -->
    <div class="form-group field-news-news_detail hidden" id="div-news-price">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="">Annouce</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <?php
                        echo "<div class='demo-checkbox'>";
                        echo Html::checkbox('News[news_price]',$model->news_price,[
                            'id' => 'news-news_price',
                            'class' => 'filled-in chk-col-light-green checkbox-form',
                            // 'data-q-id' => $q->q_id,
                            // 'data-qs-id' => $qs->qs_id,
                            // 'data-dep-id' => Yii::$app->user->identity->dep_id,
                            // 'data-value' => 0,
                            // 'data-month' => $month->month_id,
                        ]);
                        echo "<label for='news-news_price'></label></div>";
                    ?>
            </div>
        </div>
    </div>
	
	<?php
        echo $form->field($model, 'news_title',[
            'template' => Yii::$app->params['template'],
            'labelOptions' => ['class' => ''],
        ])->textInput(['maxlength' => true, 'placeholder' => 'title']);
    ?>

    <!-- Detail -->
    <div class="form-group field-news-news_detail">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="">Detail</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <?php echo FroalaEditorWidget::widget([
                            'model' => $model,
                            'attribute' => 'news_detail',
                            'options'=>[
                                'id'=>'content',
                            ],
                            'clientOptions'=>[
                                'toolbarInline'=> false,
                                'theme' =>'royal',
                                'language'=>'en_us',
                                'height'=> 300,
								'fileMaxSize' => 1920 * 1084 * 100,
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

    <!-- Image -->
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="">
                <?php echo $model->getAttributeLabel('news_img'); ?>
            </label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <?php  
                        echo Yii::$app->mpic->picform($model,'news_img','news','News');
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
<script>
    $(document).ready(function() {
		<?php if($model->type_id == 5){ ?>
        	$('#div-news-price').removeClass('hidden');
    	<?php } ?>
		
        $('#news-type_id').change(function(event) {
            freedom = $(this).val();
			if(freedom == 5){
				$('#div-news-price').removeClass('hidden');
			}else{
				$('#div-news-price').addClass('hidden');
			}
        });
    });
</script>