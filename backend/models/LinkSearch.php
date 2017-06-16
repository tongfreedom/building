<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Link;

class LinkSearch extends Link
{
    public function rules()
    {
        return [
            [['link_id', 'link_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['link_name', 'link_url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Link::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'link_order' => SORT_ASC,
                    'create' => SORT_DESC,
                    'link_id' => SORT_DESC, 
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'link_id' => $this->link_id,
            'link_order' => $this->link_order,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => 1,
            'lan_id' => 1,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'link_name', $this->link_name])
            ->andFilterWhere(['like', 'link_url', $this->link_url]);

        return $dataProvider;
    }
}
