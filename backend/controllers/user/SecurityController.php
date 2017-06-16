<?php
namespace backend\controllers\user;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\Finder;
use dektrium\user\models\Account;
use dektrium\user\models\LoginForm;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class SecurityController extends BaseSecurityController
{
    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        if(isset($_POST['checkLogin'])){
            if($_POST['checkLogin'] == 1){
                if(isset(\Yii::$app->session['count_login'])){
                    if(\Yii::$app->session['count_login'] >= 4){
                        return "lock";
                        exit;
                    }
                    \Yii::$app->session['count_login'] = \Yii::$app->session['count_login']+1;
                }else{
                    \Yii::$app->session['count_login'] = 1;
                }
            }else{
                unset(\Yii::$app->session['count_login']);
            }
        }
        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

       
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack();
        }
        

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
}