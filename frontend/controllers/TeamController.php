<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Team;
use frontend\models\Department;
use yii\web\Controller;
use yii\data\Pagination;


class TeamController extends Controller
{
    public function actionIndex()
    {
        $department = Department::find()->where([
            'active' => 1,
            'publish' => 1,
            'lan_id' => Yii::$app->languages->id,
        ])->orderBy(['dep_order' => 'DESC'])->all();

        foreach ($department as $dep) {
            $model[$dep->dep_id] = Team::find()->where(['=','active',1])
            ->andWhere(['=', 'publish', 1])
            ->andWhere(['=', 'lan_id', Yii::$app->languages->id])
            ->andWhere(['=', 'dep_id', $dep->dep_id])
            ->orderBy(['team_order' => SORT_ASC])
            ->all(); 
        }

        return $this->render('index', [
            'department' => $department,
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
