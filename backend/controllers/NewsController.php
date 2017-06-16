<?php
namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Type;
use yii\helpers\Url;

class NewsController extends Controller
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
                $model = News::find()
                    ->orwhere('news_id = :ID',[':ID' => $id])
                    ->orwhere('parent_id = :ID',[':ID' => $id])
                    ->all();

                if($_POST["type"] == "publish"){
                    foreach ($model as $md) {
                        $md->publish = $value;
                        $md->save(false);
                    }
                }

                if($_POST["type"] == "hot"){
                    foreach ($model as $md) {
                        $md->news_hot = $value;
                        $md->save(false);
                    }
                }
            }
            exit();
        }

        $searchModel = new NewsSearch();
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
        $model = new News();

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
                $model->news_img = Yii::$app->mpic->picsave($model,'news_img','news',1,595,397);
                $model->save(false);
            }
            

            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            Yii::$app->getSession()->setFlash('success','Success Created');
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Image Old
        $model->news_img_old = $model->news_img;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if($_GET['lan_id'] == 1){
                $model->news_img = Yii::$app->mpic->picsave($model,'news_img','news',1,595,397);
                $model->save(false);
            }

            if(!isset($_POST['News']['news_price'])){
                $model->news_price = 0;
            }
            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = News::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->news_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->news_id,$lan->id);
                            $child->save();
                        }
                    }
                }
            }

            Yii::$app->getSession()->setFlash('success','Success Updated');
            return $this->redirect(['index']);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = News::find()
            ->orwhere('news_id = :ID',[':ID' => $id])
            ->orwhere('parent_id = :parentID',[':parentID' => $id])
            ->all();

        foreach ($model as $md) {
            $md->active = 0;
            $md->save();
        }
        echo "success";
    }

    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = News::find()->where(['news_id' => $parentID])->one();
        $type = Type::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->type_id])->one();

        $model->type_id = $type->type_id;

        $model->news_img = $parent->news_img;
        $model->publish = $parent->publish;

        return  $model;  
    }
}
