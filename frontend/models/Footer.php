<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "footer".
 *
 * @property integer $foot_id
 * @property string $foot_address
 * @property string $foot_tel
 * @property string $foot_email
 * @property string $foot_work
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 * @property string $foot_detail
 * @property string $foot_map
 */
class Footer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'footer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['foot_detail'], 'string'],
            [['foot_address', 'foot_work', 'foot_map'], 'string', 'max' => 255],
            [['foot_tel', 'foot_email'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'foot_id' => 'Foot ID',
            'foot_address' => 'Foot Address',
            'foot_tel' => 'Foot Tel',
            'foot_email' => 'Foot Email',
            'foot_work' => 'Foot Work',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'foot_detail' => 'Foot Detail',
            'foot_map' => 'Foot Map',
        ];
    }
}
