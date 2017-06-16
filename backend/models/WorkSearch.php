<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Work;

class WorkSearch extends Work
{
    public function rules()
    {
        return [
            [['work_id', 'work_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['work_title', 'work_img', 'work_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Work::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'work_id' => SORT_DESC,
                    'create' => SORT_DESC,
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
            'work_id' => $this->work_id,
            'work_view' => $this->work_view,
            'tag_id' => $this->tag_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'work.active' => 1,
            'work.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'work.type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'work_title', $this->work_title])
            ->andFilterWhere(['like', 'work_img', $this->work_img])
            ->andFilterWhere(['like', 'work_detail', $this->work_detail]);

        return $dataProvider;
    }
}
