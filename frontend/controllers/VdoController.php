<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Vdo;
use frontend\models\Type;
use yii\data\Pagination;

class VdoController extends FrontendController
{
    public function actionIndex()
    {

        $query = Vdo::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->orderBy(['create' => SORT_DESC, 'vdo_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 8]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
        ]);

    }


    public function Addview($id)
    {
        $model = Vdo::find()
        ->where(['=','active',1])
        ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
        ->andWhere(['=', 'publish',1])
        ->andWhere(['=', 'vdo_id', $id])->one();

        $model->vdo_view = $model->vdo_view + 1;
        $model->save();
    }
}
