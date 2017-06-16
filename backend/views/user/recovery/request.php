<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Recover your password');
?>
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><b>TGDE</b></a>
        <small>
            Thai-German Dual Education and e-learning Development Institute
        </small>
    </div>
    <div class="card">
        <div class="body">
            <!-- <form id="forgot_password" method="POST"> -->
            <?php 
                $form = ActiveForm::begin([
                    'id'                     => 'password-recovery-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'fieldConfig' => [
                        'template' => "{input}{hint}",
                    ],
                ]); 
            ?>
                <div class="msg">
                    โปรดระบุอีเมลที่ใช้ในการสมัครสมาชิกของท่าน <br>
                    ระบบจะทำการส่งชื่อเข้าใช้งานและลิ้งค์สำหรับเปลี่ยนรหัสผ่านไปยังอีเมลของท่าน
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                       <!--  <input type="email" class="form-control" name="email" placeholder="Email" required autofocus> -->
                        <?php 
                            echo $form->field($model, 'email')->textInput([
                                'required' => 'required',
                                'autofocus' => true,
                                'tabindex' => '1',
                                'class' => 'form-control',
                                'placeholder' => 'email',
                            ])->label(false);
                        ?>
                    </div>
                </div>

                <div><?=$form->errorSummary($model,['header' => '']); ?></div>

                <?php
                    echo Html::submitButton(Yii::t('user', 'Request'),[
                        'class' => 'btn btn-block btn-lg bg-pink waves-effect', 
                        'tabindex' => '2'
                    ]);
                ?>
                <div class="row m-t-20 m-b--5 align-center">
                    <?=Html::a(Yii::t('user', 'Sign in'),['/user/security/login']); ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php  
// $this->registerJsFile($this->theme->baseUrl.'/assets/js/pages/examples/forgot-password.js', ['depends' => [\yii\web\JqueryAsset::className()]])
?>