<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;

class CompanySearch extends Company
{
    public function rules()
    {
        return [
            [['com_id', 'active', 'create', 'update', 'publish', 'lan_id', 'parent_id', 'user_id'], 'integer'],
            [['com_name', 'com_url', 'com_img'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'com_id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'com_id' => $this->com_id,
            'active' => 1,
            'create' => $this->create,
            'update' => $this->update,
            'publish' => $this->publish,
            'lan_id' => 1,
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'com_name', $this->com_name])
            ->andFilterWhere(['like', 'com_url', $this->com_url]);

        return $dataProvider;
    }
}
