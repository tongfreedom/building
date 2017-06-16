<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property integer $pic_id
 * @property string $pic_img
 * @property integer $gall_id
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gall_id', 'user_id', 'create', 'update', 'active'], 'integer'],
            [['pic_img'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pic_id' => 'รหัสรูปภาพ',
            'pic_img' => 'รูปภาพ',
            'gall_id' => 'อัลบั้มภาพ',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }
}
