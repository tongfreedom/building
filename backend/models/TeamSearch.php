<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Team;

class TeamSearch extends Team
{
    public function rules()
    {
        return [
            [['team_id', 'team_order', 'dep_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['team_prefixname', 'team_firstname', 'team_lastname', 'team_position', 'team_level', 'team_img', 'team_tel', 'team_email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Team::find();

        $query->joinWith(['department']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'dep_id' => SORT_ASC,
                    'team_order' => SORT_ASC,
                    'team_id' => SORT_DESC,
                ],
            ],
        ]);

        $dataProvider->sort->attributes['department'] = [
            'asc' => ['department.dep_name' => SORT_ASC],
            'desc' => ['department.dep_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'team_id' => $this->team_id,
            'team_order' => $this->team_order,
            'team.dep_id' => $this->dep_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'team.active' => 1,
            'team.lan_id' => 1,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'team_prefixname', $this->team_prefixname])
            ->andFilterWhere(['like', 'team_firstname', $this->team_firstname])
            ->andFilterWhere(['like', 'team_lastname', $this->team_lastname])
            ->andFilterWhere(['like', 'team_position', $this->team_position])
            ->andFilterWhere(['like', 'team_level', $this->team_level])
            ->andFilterWhere(['like', 'team_img', $this->team_img])
            ->andFilterWhere(['like', 'team_tel', $this->team_tel])
            ->andFilterWhere(['like', 'team_email', $this->team_email]);

        return $dataProvider;
    }
}
