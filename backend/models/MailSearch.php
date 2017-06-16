<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mail;

class MailSearch extends Mail
{
    public function rules()
    {
        return [
            [['mail_id', 'mail_status', 'user_id', 'create', 'update', 'active'], 'integer'],
            [['mail_name', 'mail_email', 'mail_subject', 'mail_details'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Mail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create' => SORT_DESC,
                    'mail_id' => SORT_ASC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'mail_id' => $this->mail_id,
            'mail_status' => $this->mail_status,
            'user_id' => $this->user_id,
            'create' => $this->create,
            'update' => $this->update,
            'active' => 1,
        ]);

        $query->andFilterWhere(['like', 'mail_name', $this->mail_name])
            ->andFilterWhere(['like', 'mail_email', $this->mail_email])
            ->andFilterWhere(['like', 'mail_subject', $this->mail_subject])
            ->andFilterWhere(['like', 'mail_details', $this->mail_details]);

        return $dataProvider;
    }
}
