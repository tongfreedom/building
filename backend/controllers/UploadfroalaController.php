<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\UploadFroala;

class UploadfroalaController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionUploadimage()
    {
        $model = new UploadFroala();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('file');
            if ($model->upload()) {
                return \Yii::createObject([
                    'class' => 'yii\web\Response',
                    'format' => \yii\web\Response::FORMAT_JSON,
                    'data' => [
                        'link' => Yii::$app->request->baseUrl.'/../upload/froala/' . $model->imageFile->baseName . '.' . $model->imageFile->extension,
                    ]
                ]);
            }else{
                echo "Max size";
            }
        }
    }
    public function actionUploadfile()
    {
        $model = new UploadFroala();
        if (Yii::$app->request->isPost) {
            $model->docFile = UploadedFile::getInstanceByName('file');
            if ($model->upload()) {
                return \Yii::createObject([
                    'class' => 'yii\web\Response',
                    'format' => \yii\web\Response::FORMAT_JSON,
                    'data' => [
                        'link' => Yii::$app->request->baseUrl.'/../upload/froala/doc/' . $model->docFile->baseName . '.' . $model->docFile->extension,
                    ]
                ]);
            }else{
                echo "Max size";
            }
        }
    }
    public function actionUploadvideo()
    {
        $model = new UploadFroala();
        if (Yii::$app->request->isPost) {
            $model->videoFile = UploadedFile::getInstanceByName('file');
            if ($model->upload()) {
                return \Yii::createObject([
                    'class' => 'yii\web\Response',
                    'format' => \yii\web\Response::FORMAT_JSON,
                    'data' => [
                        'link' => Yii::$app->request->baseUrl.'/../upload/froala/video/' . $model->videoFile->baseName . '.' . $model->videoFile->extension,
                    ]
                ]);
            }else{
                echo "Max size";
            }
        }
    }

}