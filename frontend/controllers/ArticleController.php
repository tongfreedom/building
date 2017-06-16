<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Article;
use frontend\models\Type;
use yii\data\Pagination;

class ArticleController extends FrontendController
{
    public function actionIndex($type_id)
    {
        $type = Type::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->one();

        $query = Article::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->orderBy(['create' => SORT_DESC, 'art_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $art_hit = Article::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'type_id', $type_id])
            ->limit(5)
            ->orderBy(['art_view' => SORT_DESC, 'create' => SORT_DESC, 'art_id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
            'type' => $type,
            'art_hit' => $art_hit,
        ]);

    }
	public function actionKm()
    {
        $query = Article::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
			->andWhere(['=', 'art_km',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->orderBy(['create' => SORT_DESC, 'art_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $art_hit = Article::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
			->andWhere(['=', 'art_km',1])
            ->limit(5)
            ->orderBy(['art_view' => SORT_DESC, 'create' => SORT_DESC, 'art_id' => SORT_DESC])
            ->all();

        return $this->render('km', [
            'model' => $models,
            'pages' => $pages,
            'art_hit' => $art_hit,
        ]);

    }
    public function actionView($id)
    {
        $this->addview($id);

    	$model = Article::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'art_id', $id])->one();

        $art_hit = Article::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $model->type_id])
            ->andWhere(['=', 'publish',1])
            ->limit(5)
            ->orderBy(['art_view' => SORT_DESC, 'create' => SORT_DESC, 'art_id' => SORT_DESC])
            ->all();

    	return $this->render('view',[
            'model' => $model,
            'art_hit' => $art_hit
        ]);
    }

    public function Addview($id)
    {
        $model = Article::find()
        ->where(['=','active',1])
        ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
        ->andWhere(['=', 'publish',1])
        ->andWhere(['=', 'art_id', $id])->one();

        $model->art_view = $model->art_view + 1;
        $model->save();
    }
}
