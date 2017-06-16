<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property integer $doc_id
 * @property string $doc_title
 * @property integer $type_id
 * @property string $doc_url
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 * @property integer $doc_view
 * @property integer $doc_type_id
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'doc_type_id'], 'required'],
            [['type_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'doc_view', 'doc_type_id'], 'integer'],
            [['doc_title', 'doc_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'รหัสเอกสาร',
            'doc_title' => 'ชื่อเอกสาร',
            'type_id' => 'ประเภทเอกสาร',
            'doc_url' => 'ที่อยู่เอกสาร',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'doc_view' => 'Doc View',
            'doc_type_id' => 'Doc Type ID',
        ];
    }
}
