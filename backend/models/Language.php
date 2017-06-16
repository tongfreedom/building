<?php

namespace backend\models;

use Yii;

class Language extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%language}}';
    }

    public function rules()
    {
        return [
            [['create', 'update', 'active'], 'integer'],
            [['lan_name', 'lan_code'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'lan_id' => 'Lan ID',
            'lan_name' => 'Language',
            'lan_code' => 'Code',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
        ];
    }
}
