<?php
namespace backend\controllers;

use Yii;
use backend\models\Gallery;
use backend\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Picture;

class GalleryController extends Controller
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        // Checkbox
        if(isset($_POST['checkbox'])){
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $value = isset($_POST['value']) ? $_POST['value'] : NULL;
            if($id != NULL){
                $model = Gallery::find()
                    ->orwhere('gall_id = :ID',[':ID' => $id])
                    ->orwhere('parent_id = :ID',[':ID' => $id])
                    ->all();

                if($_POST["type"] == "publish"){
                    foreach ($model as $md) {
                        $md->publish = $value;
                        $md->save(false);
                    }
                }
            }
            exit();
        }

        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Gallery();
        $picture = new Picture();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if(!isset($_GET['lan_id'])){
                $model->gall_img = Yii::$app->mpic->picsave($model,'gall_img','gallery',1,595,397);
                $model->save(false);
            }

            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            // Update Gallery
            if(isset($_POST['gallTime'])){
                Picture::updateAll(['gall_id' => $model->gall_id], ['create' => $_POST['gallTime']]);
            }

            Yii::$app->getSession()->setFlash('success','Success Created');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'picture' => $picture,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $picture = new Picture();

        // Image old
        $model->gall_img_old = $model->gall_img;

         // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if($_GET['lan_id'] == 1){
                $model->gall_img = Yii::$app->mpic->picsave($model,'gall_img','gallery',1,595,397);
                $model->save(false);
            }

            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            // update Gallery
            if(isset($_POST['gallTime'])){
                Picture::updateAll(['gall_id' => $model->gall_id], ['create' => $_POST['gallTime']]);
            }

            Yii::$app->getSession()->setFlash('success','Success Updated');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'picture' => $picture,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = Gallery::find()
            ->orwhere('gall_id = :ID',[':ID' => $id])
            ->orwhere('parent_id = :parentID',[':parentID' => $id])
            ->all();

        foreach ($model as $md) {
            
            $md->active = 0;
            $md->save();
        }
        echo "success";
    }

    public function actionDeletegall($id)
    {
          $model = Picture::findOne($id);
          $model->active = 0;
          $model->save();
          return json_encode($model->gall_id);
    }

    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Gallery::find()->where(['gall_id' => $parentID])->one();

        $model->publish = $parent->publish;
        $model->gall_img = $parent->gall_img;

        return  $model;  
    }

    public function actionUpload()
    {
          $picture = new Picture();
          
          $picture->gall_id = 1;
          $picture->pic_img = $_FILES['Picture'];
          $picture->create = $_POST['gallTime'];
          $picture->upload();

          return json_encode($picture->update);
    }
}
