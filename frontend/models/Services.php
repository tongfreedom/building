<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $service_id
 * @property string $service_name
 * @property string $service_url
 * @property integer $service_order
 * @property integer $tag_id
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_order', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['service_name', 'service_url'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => 'Service ID',
            'service_name' => 'Service Name',
            'service_url' => 'Service Url',
            'service_order' => 'ลำดับ',
            'tag_id' => 'TAG',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
        ];
    }
}
