<?php
namespace frontend\models;

use Yii;

class Gallery extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'gallery';
    }

    public function rules()
    {
        return [
            [['gall_detail'], 'string'],
            [['gall_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['gall_title'], 'string', 'max' => 255],
            [['gall_img'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'gall_id' => 'รหัสอัลบั้มภาพกิจกรรม',
            'gall_title' => 'หัวข้ออัลบั้มภาพกิจกรรม',
            'gall_img' => 'รูปภาพหน้าปก',
            'gall_detail' => 'รายละเอียดอัลบั้มภาพกิจกรรม',
            'gall_view' => 'จำนวนผู้เข้าชม',
            'tag_id' => 'TAG',
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

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }

}
