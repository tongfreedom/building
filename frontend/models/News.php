<?php
namespace frontend\models;

use Yii;


class News extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['news_detail'], 'string'],
            [['news_view', 'type_id', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id','news_hot','news_price'], 'integer'],
            [['type_id'], 'required'],
            [['news_title'], 'string', 'max' => 255],
            [['news_img'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'news_id' => 'รหัสข่าว',
            'news_title' => 'หัวข้อข่าว',
            'news_img' => 'ภาพหน้าปกข่าว',
            'news_detail' => 'รายละเอียดข่าว',
            'news_view' => 'จำนวนผู้เข้าชม',
            'type_id' => 'ประเภทข่าว',
            'tag_id' => 'TAG',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'news_hot' => 'Hot News',
			'news_price' => 'ประกาศ/ประกวดราคา'
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
