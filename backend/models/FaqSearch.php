<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faq;

class FaqSearch extends Faq
{
    public $type;

    public function rules()
    {
        return [
            [['faq_id', 'faq_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['faq_question', 'faq_answer'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Faq::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'faq_order' => SORT_ASC,
                    'create' => SORT_DESC,
                    'faq_id' => SORT_ASC,
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
            'faq_id' => $this->faq_id,
            'faq_order' => $this->faq_order,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'faq.active' => 1,
            'faq.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'faq.type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'faq_question', $this->faq_question])
            ->andFilterWhere(['like', 'faq_answer', $this->faq_answer]);

        return $dataProvider;
    }
}
