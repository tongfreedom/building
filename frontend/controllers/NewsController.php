<?php
namespace frontend\controllers;
use Yii;
use frontend\models\News;
use frontend\models\Type;
use yii\data\Pagination;

class NewsController extends FrontendController
{
    public function actionIndex($type_id)
    {
        $type = Type::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->one();

        $query = News::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->orderBy(['create' => SORT_DESC, 'news_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $news_hit = News::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'type_id', $type_id])
            ->limit(5)
            ->orderBy(['news_view' => SORT_DESC, 'create' => SORT_DESC, 'news_id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
            'type' => $type,
            'news_hit' => $news_hit,
        ]);

    }
	
	public function actionNewsprice()
    {
        $type = Type::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['IN', 'type_id', [5,6]])
            ->one();
		
        $query = News::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type->type_id])
			->andWhere(['=', 'news_price', 1])
            ->orderBy(['create' => SORT_DESC, 'news_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $news_hit = News::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'type_id', $type->type_id])
            ->limit(5)
            ->orderBy(['news_view' => SORT_DESC, 'create' => SORT_DESC, 'news_id' => SORT_DESC])
            ->all();

        return $this->render('newsprice', [
            'model' => $models,
            'pages' => $pages,
            'type' => $type,
            'news_hit' => $news_hit,
        ]);

    }
	
    public function actionView($id)
    {
        $this->addview($id);

    	$model = News::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'news_id', $id])->one();

        $news_hit = News::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $model->type_id])
            ->andWhere(['=', 'publish',1])
            ->limit(5)
            ->orderBy(['news_view' => SORT_DESC, 'create' => SORT_DESC, 'news_id' => SORT_DESC])
            ->all();

    	return $this->render('view',[
            'model' => $model,
            'news_hit' => $news_hit
        ]);
    }

    public function Addview($id)
    {
        $model = News::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'news_id', $id])->one();

        $model->news_view = $model->news_view + 1;
        $model->save();
    }
}
