<?php
namespace backend\controllers;

use Yii;
use backend\models\Mail;
use backend\models\MailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Reply;

class MailController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // Checkbox
        if(isset($_POST['checkbox'])){
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $value = isset($_POST['value']) ? $_POST['value'] : NULL;
            if($id != NULL){
                $model = Mail::find()
                    ->where('mail_id = :ID',[':ID' => $id])
                    ->one();

                if($_POST["type"] == "status"){
                    $model->mail_status = $value;
                    $model->save(false);
                }
            }
            exit();
        }

        $searchModel = new MailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $reply = Reply::find()->where(['mail_id' => $id,'active' => 1])->one();
        $model = $this->findModel($id);

        if(!$reply){
            $reply = new Reply;
        }

        if ($reply->load(Yii::$app->request->post()) && $reply->save()) {

            // Send mail
            // 
            
            // Update Status
            $model->mail_status = 1;
            $model->save();

            Yii::$app->getSession()->setFlash('success','Success Reply');
            return $this->redirect(['mail/index']);

        } else {
            return $this->render('view', [
                'model' => $model,
                'reply' => $reply,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Mail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
