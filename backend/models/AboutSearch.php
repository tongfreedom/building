<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\About;

class AboutSearch extends About
{
    public function rules()
    {
        return [
            [['about_id', 'about_view', 'about_order', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['about_title', 'about_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = About::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'about_order' => SORT_ASC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'about_id' => $this->about_id,
            'about_view' => $this->about_view,
            'about_order' => $this->about_order,
            'tag_id' => $this->tag_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => 1,
            'lan_id' => 1,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'about_title', $this->about_title])
            ->andFilterWhere(['like', 'about_detail', $this->about_detail]);

        return $dataProvider;
    }
}
