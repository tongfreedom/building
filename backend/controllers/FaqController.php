<?php
namespace backend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use himiklab\sortablegrid\SortableGridAction;
use backend\models\Type;

class FaqController extends Controller
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Faq::className(),
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
                $model = Faq::find()
                    ->orwhere('faq_id = :ID',[':ID' => $id])
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

        $searchModel = new FaqSearch();
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
        $model = new Faq();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }
        
        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Order
            $count = Faq::find()->limit(1)->where([
                'active' => 1,
                'lan_id' => $model->lan_id,
                'type_id' => $model->type_id,
            ])->orderBy(['faq_order'=>SORT_DESC])->one();

            $model->faq_order = $count->faq_order;
            $model->save();

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

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Faq::find()->where([
                        'lan_id'=>$lan->id,'parent_id' => $model->faq_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->faq_id,$lan->id);
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
        $model = Faq::find()
            ->orwhere('faq_id = :ID',[':ID' => $id])
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
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Faq::find()->where(['faq_id' => $parentID])->one();
        $type = Type::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->type_id])->one();

        $model->type_id = $type->type_id;
        $model->publish = $parent->publish;
        $model->faq_order = $parent->faq_order;
        
        return  $model;  
    }
}
