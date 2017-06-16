<?php
namespace backend\controllers;

use Yii;
use backend\models\Work;
use backend\models\WorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Type;
use yii\helpers\Url;

class WorkController extends Controller
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
                $model = Work::find()
                    ->orwhere('work_id = :ID',[':ID' => $id])
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

        $searchModel = new WorkSearch();
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
        $model = new Work();

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
                $model->work_img = Yii::$app->mpic->picsave($model,'work_img','work',1,595,397);
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
        $model->work_img_old = $model->work_img;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if($_GET['lan_id'] == 1){
                $model->work_img = Yii::$app->mpic->picsave($model,'work_img','work',1,595,397);
                $model->save(false);
            }

            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Work::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->work_id])->one();
                        
                        if($child){
                            $child = $this->savelang($child,$model->work_id,$lan->id);
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
        $model = Work::find()
            ->orwhere('work_id = :ID',[':ID' => $id])
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
        if (($model = Work::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Work::find()->where(['work_id' => $parentID])->one();
        $type = Type::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->type_id])->one();

        $model->type_id = $type->type_id;
        $model->work_img = $parent->work_img;
        $model->publish = $parent->publish;

        return  $model;  
    }
}
