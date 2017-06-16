<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Gallery;
use frontend\models\Picture;
use yii\data\Pagination;

class GalleryController extends FrontendController
{
    public function actionIndex()
    {
        $query = Gallery::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->orderBy(['create' => SORT_DESC, 'gall_id' => SORT_DESC]);

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
    public function actionView($id)
    {
        $this->addview($id);

    	$gallery = Gallery::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'gall_id', $id])->one();

        $model = Picture::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'gall_id', $id])->all();

    	return $this->render('view',[
            'gallery' => $gallery,
            'model' => $model,
        ]);
    }

    public function Addview($id)
    {
        $model = Gallery::find()
        ->where(['=','active',1])
        ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
        ->andWhere(['=', 'publish',1])
        ->andWhere(['=', 'gall_id', $id])->one();

        $model->gall_view = $model->gall_view + 1;
        $model->save();
    }
}
