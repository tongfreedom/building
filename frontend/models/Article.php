<?php
namespace frontend\models;

use Yii;

class Article extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['art_detail'], 'string'],
            [['art_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id','art_km'], 'integer'],
            [['art_title'], 'string', 'max' => 255],
            [['art_img'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'art_id' => 'รหัสบทความ',
            'art_title' => 'หัวข้อบทความ',
            'art_img' => 'รูปภาพหน้าปก',
            'art_detail' => 'รายละเอียดบทความ',
            'art_view' => 'จำนวนผู้เข้าชม',
            'tag_id' => 'TAG',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'type_id' => 'Type ID',
			'art_km' => 'การจัดการความรู้',
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
