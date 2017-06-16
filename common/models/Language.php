<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property integer $lan_id
 * @property string $lan_name
 * @property string $lan_code
 * @property integer $create
 * @property integer $update
 * @property integer $active
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create', 'update', 'active'], 'integer'],
            [['lan_name', 'lan_code'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lan_id' => 'รหัสภาษา',
            'lan_name' => 'ภาษา',
            'lan_code' => 'โค้ดภาษา',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }
}
