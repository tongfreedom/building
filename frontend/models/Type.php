<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $type_id
 * @property string $type_name
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'รหัสประเภทข่าว',
            'type_name' => 'ประเภทข่าว',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
        ];
    }
}
