<?php
namespace frontend\models;

use Yii;

class About extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'about';
    }

    public function rules()
    {
        return [
            [['about_detail'], 'string'],
            [['about_view', 'about_order', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['about_title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'about_id' => 'รหัสเกี่ยวกับเรา',
            'about_title' => 'หัวข้อเกี่ยวกับเรา',
            'about_detail' => 'รายละเอียดเกี่ยวกับเรา',
            'about_view' => 'จำนวนผู้เข้าชม',
            'about_order' => 'ลำดับ',
            'tag_id' => 'TAG',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'ภาษาหลัก',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}
