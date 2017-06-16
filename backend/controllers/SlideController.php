<?php
namespace backend\controllers;

use Yii;
use backend\models\Slide;
use backend\models\SlideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use himiklab\sortablegrid\SortableGridAction;

class SlideController extends Controller
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

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Slide::className(),
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
                $model = Slide::find()
                    ->orwhere('slide_id = :ID',[':ID' => $id])
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

        $searchModel = new SlideSearch();
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
        $model = new Slide();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }
        
        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Order
            $count = Slide::find()->limit(1)->where([
                'active' => 1,
                'lan_id' => $model->lan_id,
            ])->orderBy(['slide_order'=>SORT_DESC])->one();

            $model->slide_order = $count->slide_order;
            $model->save();

            // Image & Video
            if(!isset($_GET['lan_id'])){
                $model->slide_img = Yii::$app->mpic->picsave($model,'slide_img','slide',1);
                $model->slide_vdo = Yii::$app->mpic->picsave($model,'slide_vdo','slide',2);
                $model->save(false);
            }

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

        // Image & Video Old
        $model->slide_img_old = $model->slide_img;
        $model->slide_vdo_old = $model->slide_vdo;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image & Video
            if($_GET['lan_id'] == 1){
                $model->slide_img = Yii::$app->mpic->picsave($model,'slide_img','slide');
                $model->slide_vdo = Yii::$app->mpic->picsave($model,'slide_vdo','slide',2);
                $model->save(false);
            }

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Slide::find()->where([
                        'lan_id' => $lan->id,'parent_id' => $model->slide_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->slide_id,$lan->id);
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
        $model = Slide::find($id)
            ->orwhere('slide_id = :ID',[':ID' => $id])
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
        if (($model = Slide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Slide::find()->where(['slide_id' => $parentID])->one();

        $model->slide_checklink = $parent->slide_checklink;
        $model->slide_link = $parent->slide_link;   
        $model->publish = $parent->publish; 
        $model->slide_order = $parent->slide_order;
        $model->slide_img = $parent->slide_img;
        $model->slide_type = $parent->slide_type;

        return  $model;  
    }
}
