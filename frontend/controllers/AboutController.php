<?php
namespace frontend\controllers;

use Yii;
use frontend\models\About;
use yii\web\Controller;
use frontend\models\Tag;

class AboutController extends Controller
{
    public function actionView($id)
    {
        $this->addview($id);

        $about = About::find()->where(['=', 'active', 1])
            ->andWhere(['=', 'publish', 1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->orderBy(['about_order' => SORT_ASC, 'create' => SORT_ASC, 'about_id' => SORT_ASC])
            ->all();

        $model = $this->findModel($id);

        $tag = Tag::find()->andWhere(['=', 'tag_id', $model->tag_id])->all();

        return $this->render('view', [
            'model' => $model,
            'about' => $about,
            'tag' => $tag

        ]);
    }

    protected function findModel($id)
    {
        if (($model = About::find()->where(['=', 'active', 1])
            ->andWhere(['=', 'publish', 1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'about_id', $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Addview($id)
    {
        $model = About::find()
            ->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'about_id', $id])->one();

        $model->about_view = $model->about_view + 1;
        $model->save();
    }

}
