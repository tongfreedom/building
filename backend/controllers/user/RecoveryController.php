<?php

namespace backend\controllers\user;
use dektrium\user\controllers\RecoveryController as BaseRecoveryController;

use dektrium\user\Finder;
use dektrium\user\models\RecoveryForm;
use dektrium\user\models\Token;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RecoveryController extends BaseRecoveryController
{
    
    public function actionRequest()
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => RecoveryForm::SCENARIO_REQUEST,
        ]);
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_REQUEST, $event);

        if ($model->load(\Yii::$app->request->post()) && $model->sendRecoveryMessage()) {
            $this->trigger(self::EVENT_AFTER_REQUEST, $event);
            return  $this->redirect(['security/login']);
            // return $this->render('message', [
            //     'title'  => \Yii::t('user', 'Recovery message sent'),
            //     'text' => '',
            //     'type' => 'success',
            //     'url' => 'user/login'
            // ]);
        }
        return $this->render('request', [
            'model' => $model,
        ]);
    }

    public function actionReset($id, $code)
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var Token $token */
        $token = $this->finder->findToken(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY])->one();
        $event = $this->getResetPasswordEvent($token);

        $this->trigger(self::EVENT_BEFORE_TOKEN_VALIDATE, $event);

        if ($token === null || $token->isExpired || $token->user === null) {
            return $this->render('message', [
                'title'  => \Yii::t('user', 'Invalid or expired link'),
                'text' => '',
                'type' => 'error',
                'url' => 'user/recovery/request'
                
            ]);
        }

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => RecoveryForm::SCENARIO_RESET,
        ]);
        $event->setForm($model);

        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_RESET, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->resetPassword($token)) {
            $this->trigger(self::EVENT_AFTER_RESET, $event);
            return  $this->redirect(['security/login']);
            // return $this->render('/message', [
            //     'title'  => \Yii::t('user', 'Password has been changed'),
            //     'module' => $this->module,
            // ]);

        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}
