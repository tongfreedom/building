<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Faq;
use frontend\models\Type;
use yii\data\Pagination;

class FaqController extends FrontendController
{
    public function actionIndex($type_id)
    {
        $type = Type::find()->where(['=','active',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->one();

        $query = Faq::find()->where(['=','active',1])
            ->andWhere(['=', 'publish',1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'type_id', $type_id])
            ->orderBy(['faq_order' => 'SORT_ASC','create' => SORT_DESC, 'faq_id' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
            'type' => $type,
        ]);

    }
}
