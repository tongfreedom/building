<?php

namespace backend\models;

use Yii;

class Tag extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%tag}}';
    }

    public function rules()
    {
        return [
            [['tag_name'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tag_id' => 'TAG ID',
            'tag_name' => 'TAG',
        ];
    }
}
