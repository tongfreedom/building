<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Setting;

class SettingSearch extends Setting
{

    public function rules()
    {
        return [
            [['st_id', 'active', 'create', 'update', 'user_id'], 'integer'],
            [['st_email', 'st_password', 'st_analytic'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'st_id' => $this->st_id,
            'active' => $this->active,
            'create' => $this->create,
            'update' => $this->update,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'st_email', $this->st_email])
            ->andFilterWhere(['like', 'st_password', $this->st_password])
            ->andFilterWhere(['like', 'st_analytic', $this->st_analytic]);

        return $dataProvider;
    }
}
