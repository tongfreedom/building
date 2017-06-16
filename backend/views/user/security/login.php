<?php  
use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
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
                <?php 
                    $form = ActiveForm::begin([
                        'id'                     => 'login-form',
                        'enableAjaxValidation'   => true,
                        'enableClientValidation' => false,
                        'validateOnBlur'         => false,
                        'validateOnType'         => false,
                        'validateOnChange'       => false,
                        'fieldConfig' => [
                            'template' => "{input}{hint}",
                        ],
                    ]);
                ?>
                    <div class="msg">Admin Login</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <?php
                                echo $form->field($model,'login',[
                                    'inputOptions' => [
                                        'autofocus' => 'autofocus', 
                                        'required' => 'required',
                                        'class' => 'form-control', 
                                        'tabindex' => '1',
                                        'placeholder' => 'Username'
                                    ],
                                ])->label(false);
                            ?>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <?php 
                                echo $form->field($model,'password',[
                                    'inputOptions' => [
                                        'required' => 'required',
                                        'class' => 'form-control', 
                                        'tabindex' => '2',
                                        'placeholder' => 'Password'
                                    ]
                                ])->passwordInput()->label(false);
                            ?>
                        </div>
                    </div>
                    <div><?=$form->errorSummary($model,['header' => '']); ?></div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="login-form[rememberMe]" id="rememberme" class="filled-in chk-col-pink" value="1">
                            <label for="rememberme">remember</label>
                        </div>

                        <div class="col-xs-4">
                            <?php
                                echo Html::submitButton(Yii::t('user', 'Sign in'),[
                                    'class' => 'btn btn-block bg-pink waves-effect', 
                                    'tabindex' => '3'
                                ]);
                            ?>
                            
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 align-right">
                            <?php
                                echo Html::a('Forgot Password ?',['/user/recovery/request'],['tabindex' => '5']);
                            ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>