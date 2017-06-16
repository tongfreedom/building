<?php
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Department;
?>

<?php  
$template = '<div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                {label}
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        {input}{error}
                    </div>
                </div>
            </div>
        </div>';
?>

<!-- Email -->
<?= $form->field($user, 'email',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'email']) 
?>

<!-- Username -->
<?= $form->field($user, 'username',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->textInput(['maxlength' => true, 'placeholder' => 'username']) 
?>

<!-- Password -->
<?= $form->field($user, 'password',[
            'template' => $template,
            'labelOptions' => ['class' => ''],
    ])->passwordInput(['maxlength' => true, 'placeholder' => 'password']) 
?>