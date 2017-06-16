<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property integer $faq_id
 * @property string $faq_question
 * @property string $faq_answer
 * @property integer $faq_order
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 * @property integer $type_id
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_question', 'faq_answer'], 'string'],
            [['faq_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'รหัส FAQ',
            'faq_question' => 'คำถาม',
            'faq_answer' => 'คำตอบ',
            'faq_order' => 'ลำดับ',
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
