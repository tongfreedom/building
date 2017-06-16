<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vdo".
 *
 * @property integer $vdo_id
 * @property string $vdo_title
 * @property string $vdo_img
 * @property string $vdo_url
 * @property integer $vdo_view
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 * @property integer $type_id
 */
class Vdo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vdo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vdo_view', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['vdo_title', 'vdo_url'], 'string', 'max' => 255],
            [['vdo_img'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vdo_id' => 'รหัสวีดีโอ',
            'vdo_title' => 'หัวข้อวีดีโอ',
            'vdo_img' => 'รูปภาพหน้าปก',
            'vdo_url' => 'ที่อยู่วีดีโอ',
            'vdo_view' => 'จำนวนผู้เข้าชม',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'type_id' => 'Type ID',
        ];
    }
}
