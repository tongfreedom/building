<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $dep_id
 * @property string $dep_name
 * @property integer $dep_order
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['dep_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'รหัสแผนก',
            'dep_name' => 'ชื่อแผนก',
            'dep_order' => 'ลำดับ',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
        ];
    }
}
