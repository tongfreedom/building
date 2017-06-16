<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Article;

class ArticleSearch extends Article
{
    public $type;
    public function rules()
    {
        return [
            [['art_id', 'art_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id','art_km'], 'integer'],
            [['art_title', 'art_img', 'art_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'art_id' => SORT_ASC,
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
            'art_id' => $this->art_id,
            'art_view' => $this->art_view,
            'tag_id' => $this->tag_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'article.active' => 1,
            'article.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'article.type_id' => $this->type_id,
			'art_km' => $this->art_km,
        ]);

        $query->andFilterWhere(['like', 'art_title', $this->art_title])
            ->andFilterWhere(['like', 'art_img', $this->art_img])
            ->andFilterWhere(['like', 'art_detail', $this->art_detail]);

        return $dataProvider;
    }
}
