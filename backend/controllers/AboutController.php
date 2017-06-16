<?php
namespace backend\controllers;

use Yii;
use backend\models\About;
use backend\models\AboutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use himiklab\sortablegrid\SortableGridAction;

class AboutController extends Controller
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => About::className(),
            ],
        ];
    }

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
                $model = About::find()
                    ->orwhere('about_id = :ID',[':ID' => $id])
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

        $searchModel = new AboutSearch();
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
        $model = new About();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Order
            $count = About::find()->limit(1)->where([
                'active' => 1,
                'lan_id' => $model->lan_id,
            ])->orderBy(['about_order'=>SORT_DESC])->one();

            $model->about_order = $count->about_order;
            $model->save();
            
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

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Tag
            $model->tag_id = Yii::$app->mtag->tagsave($model->tag_id,$model->tag);
            $model->save(false);

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = About::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->about_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->about_id,$lan->id);
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
        $model = About::find()
            ->orwhere('about_id = :ID',[':ID' => $id])
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
        if (($model = About::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = About::find()->where(['about_id' => $parentID])->one();

        $model->publish = $parent->publish;
        $model->about_order = $parent->about_order;
        
        return  $model;  
    }
}
