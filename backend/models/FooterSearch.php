<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Footer;

/**
 * FooterSearch represents the model behind the search form about `backend\models\Footer`.
 */
class FooterSearch extends Footer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foot_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['foot_address', 'foot_tel', 'foot_email', 'foot_work', 'foot_detail', 'foot_map'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Footer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'foot_id' => $this->foot_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => $this->active,
            'lan_id' => $this->lan_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'foot_address', $this->foot_address])
            ->andFilterWhere(['like', 'foot_tel', $this->foot_tel])
            ->andFilterWhere(['like', 'foot_email', $this->foot_email])
            ->andFilterWhere(['like', 'foot_work', $this->foot_work])
            ->andFilterWhere(['like', 'foot_detail', $this->foot_detail])
            ->andFilterWhere(['like', 'foot_map', $this->foot_map]);

        return $dataProvider;
    }
}
