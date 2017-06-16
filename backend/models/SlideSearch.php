<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Slide;

class SlideSearch extends Slide
{
    public function rules()
    {
        return [
            [['slide_id', 'slide_order', 'user_id', 'lan_id', 'parent_id', 'create', 'update', 'active', 'slide_type', 'publish', 'slide_view'], 'integer'],
            [['slide_title', 'slide_img', 'slide_link', 'slide_vdo'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Slide::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'slide_order' => SORT_ASC,
                    'create' => SORT_DESC,
                    'slide_id' => SORT_DESC, 
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'slide_id' => $this->slide_id,
            'slide_order' => $this->slide_order,
            'user_id' => $this->user_id,
            'lan_id' => 1,
            'parent_id' => $this->parent_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => 1,
            'slide_type' => $this->slide_type,
            'publish' => $this->publish,
            'slide_view' => $this->slide_view
        ]);

        $query->andFilterWhere(['like', 'slide_title', $this->slide_title])
            ->andFilterWhere(['like', 'slide_img', $this->slide_img])
            ->andFilterWhere(['like', 'slide_link', $this->slide_link])
            ->andFilterWhere(['like', 'slide_vdo', $this->slide_vdo]);

        return $dataProvider;
    }
}
