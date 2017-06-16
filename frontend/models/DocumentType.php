<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property integer $doc_type_id
 * @property string $doc_type_name
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $lan_id
 * @property integer $parent_id
 * @property integer $active
 * @property integer $type_id
 * @property integer $doc_type_order
 */
class DocumentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publish', 'user_id', 'create', 'update', 'lan_id', 'parent_id', 'active', 'type_id', 'doc_type_order'], 'integer'],
            [['doc_type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_type_id' => 'รหัสประเภทเอกสาร',
            'doc_type_name' => 'ประเภทเอกสาร',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
            'active' => 'Active',
            'type_id' => 'Type ID',
            'doc_type_order' => 'Doc Type Order',
        ];
    }
}
