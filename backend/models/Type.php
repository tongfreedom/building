<?php

namespace backend\models;

use Yii;

class Type extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'type';
    }

    public function rules()
    {
        return [
            [['user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['type_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
        ];
    }
}
