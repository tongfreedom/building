<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DocumentType;

class DocumentTypeSearch extends DocumentType
{
    public $type;

    public function rules()
    {
        return [
            [['doc_type_id', 'publish', 'user_id', 'create', 'update', 'lan_id', 'parent_id', 'active', 'type_id','doc_type_order'], 'integer'],
            [['doc_type_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DocumentType::find();
        $query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'type_id' => SORT_ASC,
                    'doc_type_order' => SORT_ASC,
                    'create' => SORT_DESC,
                    'doc_type_id' => SORT_ASC,
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
            'doc_type_id' => $this->doc_type_id,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'document_type.lan_id' => 1,
            'parent_id' => $this->parent_id,
            'document_type.active' => 1,
            'document_type.type_id' => $this->type_id,
            'doc_type_order' => $this->doc_type_order,
        ]);

        $query->andFilterWhere(['like', 'doc_type_name', $this->doc_type_name]);

        return $dataProvider;
    }
}
