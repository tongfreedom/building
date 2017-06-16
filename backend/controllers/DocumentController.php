<?php
namespace backend\controllers;

use Yii;
use backend\models\Document;
use backend\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\DocumentType;
use backend\models\Type;
use yii\helpers\Json;

class DocumentController extends Controller
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
                $model = Document::find()
                    ->orwhere('doc_id = :ID',[':ID' => $id])
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

        $searchModel = new DocumentSearch();
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
        $model = new Document();

        // Language
        if(isset($_GET['lan_id'])){
            if($_GET['lan_id'] != 1){
                $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);  
            }
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Document
            if(!isset($_GET['lan_id'])){
                $model->doc_url = Yii::$app->mdoc->docsave($model,'doc_url','document');
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

        // Document Old
        $model->doc_url_old = $model->doc_url;

        // Language
        if($_GET['lan_id'] != 1){
            $model = $this->savelang($model,$_GET['parent_id'],$_GET['lan_id']);   
        }

        // Save
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Document
            if($_GET['lan_id'] == 1){
                $model->doc_url = Yii::$app->mdoc->docsave($model,'doc_url','document');
                $model->save(false);
            }

            // Child
            if($model->lan_id == 1){
                $language = Yii::$app->languages->all;
                foreach ($language as $lan) {
                    if($lan->id != 1){
                        $child = Document::find()->where([
                        'lan_id' => $lan->id,'parent_id' => $model->doc_id])->one();
                        if($child){
                            $child = $this->savelang($child,$model->doc_id,$lan->id);
                            $child->save(); 
                        }
                    }
                }
            }

            Yii::$app->getSession()->setFlash('success','Success Created');
            return $this->redirect(['index']);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = Document::find($id)
            ->orwhere('doc_id = :ID',[':ID' => $id])
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
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Savelang($model,$parentID,$lanID)
    {
        $parent = Document::find()->where(['doc_id' => $parentID])->one();
        
        $doctype = DocumentType::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->doc_type_id])->one();
        $type = Type::find()->where(['lan_id'=>$lanID,'parent_id'=>$parent->type_id])->one();

        $model->type_id = $type->type_id;
        $model->doc_type_id = $doctype->doc_type_id;
        $model->doc_url = $parent->doc_url;
        $model->publish = $parent->publish;

        return  $model;  
    }

    public function actionGetDoctype() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
             $parents = $_POST['depdrop_parents'];
             if ($parents != null) {
                 $type_id = $parents[0];

                $doctype = DocumentType::find()->where([
                    'type_id' => $type_id,
                    'active' => 1,
                ])->orderby(['doc_type_order' => SORT_ASC])->all();

                $out = $this->MapData($doctype,'doc_type_id','doc_type_name');

                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
             }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
     }

    protected function MapData($datas,$fieldId,$fieldName){
         $obj = [];
         foreach ($datas as $key => $value) {
             array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
         }
         return $obj;
     }
}
