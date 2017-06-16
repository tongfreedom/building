<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\News;

class NewsSearch extends News
{
    public function rules()
    {
        return [
            [['news_id', 'news_view', 'type_id', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'news_hot'], 'integer'],
            [['news_title', 'news_img', 'news_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = News::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'news_id' => SORT_ASC,
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
            'news_id' => $this->news_id,
            'news_view' => $this->news_view,
            'news.type_id' => $this->type_id,
            'tag_id' => $this->tag_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'news.active' => 1,
            'news.lan_id' => 1,
            'news_hot' => $this->news_hot,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'news_img', $this->news_img])
            ->andFilterWhere(['like', 'news_detail', $this->news_detail]);

        return $dataProvider;
    }
}
