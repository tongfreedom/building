<?php
namespace frontend\models;

use Yii;

class Work extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'work';
    }

    public function rules()
    {
        return [
            [['work_detail'], 'string'],
            [['work_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['work_title'], 'string', 'max' => 255],
            [['work_img'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'work_id' => 'รหัสผลงาน',
            'work_title' => 'ชื่อผลงาน',
            'work_img' => 'รูปภาพหน้าปก',
            'work_detail' => 'รายละเอียดผลงาน',
            'work_view' => 'จำนวนผู้เข้าชม',
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
