<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Footer;
use frontend\models\Mail;

class ContactController extends FrontendController
{
    public function actionIndex()
    {
        $model = Footer::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->one();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionMail()
    {
        $model = new Mail();

        $model->mail_name = $_POST['widget-contact-form-name'];
        $model->mail_email = $_POST['widget-contact-form-email'];
        $model->mail_subject = $_POST['widget-contact-form-subject'];
        $model->mail_details = $_POST['widget-contact-form-message'];

        if ($model->save()) {
            $res = 'success';
        }else{
            $res = 'success';
        }
        echo $res;
    }
}
