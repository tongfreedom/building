<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vdo;

class VdoSearch extends Vdo
{
    public $type;
    
    public function rules()
    {
        return [
            [['vdo_id', 'vdo_view', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['vdo_title', 'vdo_img', 'vdo_url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Vdo::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'vdo_id' => SORT_ASC,
                ],
            ],
        ]);

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['type.type_name' => SORT_ASC],
            'desc' => ['type.type_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vdo_id' => $this->vdo_id,
            'vdo_view' => $this->vdo_view,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'vdo.active' => 1,
            'vdo.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'vdo.type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'vdo_title', $this->vdo_title])
            ->andFilterWhere(['like', 'vdo_img', $this->vdo_img])
            ->andFilterWhere(['like', 'vdo_url', $this->vdo_url]);

        return $dataProvider;
    }
}
