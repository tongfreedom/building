<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Gallery;

class GallerySearch extends Gallery
{
    public function rules()
    {
        return [
            [['gall_id', 'gall_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['gall_title', 'gall_img', 'gall_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Gallery::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'gall_id' => SORT_DESC, 
                ]
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
            'gall_id' => $this->gall_id,
            'gall_view' => $this->gall_view,
            'tag_id' => $this->tag_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'gallery.active' => 1,
            'gallery.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'gallery.type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'gall_title', $this->gall_title])
            ->andFilterWhere(['like', 'gall_img', $this->gall_img])
            ->andFilterWhere(['like', 'gall_detail', $this->gall_detail]);

        return $dataProvider;
    }
}
