<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Services;

class ServicesSearch extends Services
{
    public function rules()
    {
        return [
            [['service_id', 'service_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['service_name', 'service_url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Services::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'service_order' => SORT_ASC,
                    'create' => SORT_DESC,
                    'service_id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'service_id' => $this->service_id,
            'service_order' => $this->service_order,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => 1,
            'lan_id' => 1,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'service_name', $this->service_name])
            ->andFilterWhere(['like', 'service_url', $this->service_url]);

        return $dataProvider;
    }
}
