<?php
namespace backend\controllers;

use Yii;
use backend\models\Team;
use backend\models\TeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Department;
use yii\helpers\Url;
use himiklab\sortablegrid\SortableGridAction;

class TeamController extends Controller
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Team::className(),
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
                $model = Team::find()
                    ->orwhere('team_id = :ID',[':ID' => $id])
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

        $searchModel = new TeamSearch();
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
        $model = new Team();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Order
            $count = Team::find()->limit(1)->where([
                'active' => 1,
                'lan_id' => $model->lan_id,
                'dep_id' => $model->dep_id,
            ])->orderBy(['team_order'=>SORT_DESC])->one();

            $model->team_order = $count->team_order;
            $model->save();

            // Image
            if(!isset($_GET['lan_id'])){
                $model->team_img = Yii::$app->mpic->picsave($model,'team_img','team',1,387,305);
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
        $model->team_img_old = $model->team_img;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Image
            if($_GET['lan_id'] == 1){
                $model->team_img = Yii::$app->mpic->picsave($model,'team_img','team',1,387,305);
                $model->save(false);
            }

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Team::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->team_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->team_id,$lan->id);
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
        $model = Team::find()
            ->orwhere('team_id = :ID',[':ID' => $id])
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
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Team::find()->where(['team_id' => $parentID])->one();
        $dep = Department::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->dep_id,'active' => 1])->one();

        $model->dep_id  = $dep->dep_id;
        $model->publish = $parent->publish;
        $model->team_img = $parent->team_img;
        $model->team_email = $parent->team_email;
        $model->team_order = $parent->team_order;
        $model->team_tel = $parent->team_tel;

        return  $model;  
    }
}
