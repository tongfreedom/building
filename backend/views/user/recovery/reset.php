<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <?php 
                $form = ActiveForm::begin([
                    'id'                     => 'password-recovery-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); 
            ?>
            <h1>
                <?php echo $this->title; ?>
            </h1>
            <div>
                <?= $form->field($model, 'password')->passwordInput()->label(false); ?>
            </div>
            <div>
                <?php 
                    echo Html::submitButton(Yii::t('user', 'Finish'), [
                        'class' => 'btn btn-success btn-block',
                        'tabindex' => '2'
                    ]);
                ?>
            </div>

            <div class="clearfix"></div>
            <?php ActiveForm::end(); ?>
        </section>
    </div>
</div>