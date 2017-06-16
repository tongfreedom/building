<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Document;
use frontend\models\DocumentType;
use frontend\models\Type;
use yii\data\Pagination;

class DocumentController extends FrontendController
{
    public function actionIndex($type_id, $doc_type_id = null)
    {
        $type = Type::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->one();

        $doc_type = DocumentType::find()->where(['=','active',1])
            ->andWhere(['=', 'publish', 1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->orderBy(['doc_type_order' => SORT_ASC, 'create' => SORT_ASC,'doc_type_id' => SORT_ASC])
            ->all();

        $doc_type_id_arr = [];
        foreach ($doc_type as $dt) {
            array_push($doc_type_id_arr,$dt->doc_type_id);
        }

        if($doc_type_id == null){
            $query = Document::find()->where(['=','active',1])
                ->andWhere(['=', 'document.lan_id', Yii::$app->languages->id])
                ->andWhere(['in', 'doc_type_id', $doc_type_id_arr])
                ->andWhere(['=', 'document.publish', 1])
                ->orderBy(['doc_type_id' => SORT_ASC, 'doc_id' => SORT_DESC, 'create' => SORT_DESC]);

           
            $countQuery = clone $query;
            $pages   = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 100]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'model' => $models,
                'pages' => $pages,
                'type' => $type,
                'doc_type' => $doc_type,
                'doc_type_id' => $doc_type_id,
            ]);

        }else{

         $query = Document::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'doc_type_id', $doc_type_id])
            ->andWhere(['=', 'publish', 1])
            ->orderBy(['doc_id' => SORT_DESC, 'create' => SORT_DESC]);

            $countQuery = clone $query;
            $pages   = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 100]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('view', [
                'model' => $models,
                'pages' => $pages,
                'type' => $type,
                'doc_type' => $doc_type,
                'doc_type_id' => $doc_type_id,
            ]);
        }
    }

    public function Addhit($id)
    {
        $model = Document::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'doc_id', $id])->one();

        $model->doc_view = $model->doc_view + 1;
        $model->save();
    }
}
