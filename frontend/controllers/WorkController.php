<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Work;
use yii\data\Pagination;

class WorkController extends FrontendController
{
    public function actionIndex()
    {

        $query = Work::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->orderBy(['create' => SORT_DESC, 'work_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $work_hit = Work::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->limit(5)
            ->orderBy(['work_view' => SORT_DESC, 'create' => SORT_DESC, 'work_id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
            'work_hit' => $work_hit,
        ]);

    }
    public function actionView($id)
    {
        $this->addview($id);

    	$model = Work::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'work_id', $id])->one();

        $work_hit = Work::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->limit(5)->orderBy(['work_view' => SORT_DESC, 'create' => SORT_DESC, 'work_id' => SORT_DESC])
            ->all();

    	return $this->render('view',[
            'model' => $model,
            'work_hit' => $work_hit
        ]);
    }

    public function Addview($id)
    {
        $model = Work::find()
        ->where(['=','active',1])
        ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
        ->andWhere(['=', 'publish',1])
        ->andWhere(['=', 'work_id', $id])->one();

        $model->work_view = $model->work_view + 1;
        $model->save();
    }
}
