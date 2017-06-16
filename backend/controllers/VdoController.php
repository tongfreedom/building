<?php
namespace backend\controllers;

use Yii;
use backend\models\Vdo;
use backend\models\VdoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Type;
use yii\helpers\Url;

class VdoController extends Controller
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
                $model = Vdo::find()
                    ->orwhere('vdo_id = :ID',[':ID' => $id])
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

        $searchModel = new VdoSearch();
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
        $model = new Vdo();

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
                $model->vdo_img = Yii::$app->mpic->picsave($model,'vdo_img','video',1,595,397);
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

        // Image Old
        $model->vdo_img_old = $model->vdo_img;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if($_GET['lan_id'] == 1){
                $model->vdo_img = Yii::$app->mpic->picsave($model,'vdo_img','video',1,595,397);
                $model->save(false);
            }
           
            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Vdo::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->vdo_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->vdo_id,$lan->id);
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
        $model = Vdo::find()
            ->orwhere('vdo_id = :ID',[':ID' => $id])
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
        if (($model = Vdo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Vdo::find()->where(['vdo_id' => $parentID])->one();
        $type = Type::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->type_id])->one();


        $model->type_id = $type->type_id;
        
        $model->vdo_url = $parent->vdo_url;
        $model->vdo_img = $parent->vdo_img;
        $model->publish = $parent->publish;

        return  $model;  
    }
}
