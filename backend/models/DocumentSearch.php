<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Document;

class DocumentSearch extends Document
{
    public $type, $doc_type;
    
    public function rules()
    {
        return [
            [['doc_id', 'type_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'doc_view', 'doc_type_id'], 'integer'],
            [['doc_title', 'doc_url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Document::find();
        $query->joinWith(['type']);
        $query->joinWith(['documentType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'type_id' => SORT_ASC,
                    'doc_type_id' => SORT_ASC,
                    'create' => SORT_DESC,
                    'doc_id' => SORT_DESC,
                ],
            ],
        ]);

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['type.type_name' => SORT_ASC],
            'desc' => ['type.type_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['doc_type'] = [
            'asc' => ['document_type.doc_type_name' => SORT_ASC],
            'desc' => ['document_type.doc_type_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'doc_id' => $this->doc_id,
            'document.type_id' => $this->type_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'document.active' => 1,
            'document_type.active' => 1,
            'document.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'doc_view' => $this->doc_view,
            'document.doc_type_id' => $this->doc_type_id,
        ]);

        $query->andFilterWhere(['like', 'doc_title', $this->doc_title])
            ->andFilterWhere(['like', 'doc_url', $this->doc_url]);

        return $dataProvider;
    }
}
