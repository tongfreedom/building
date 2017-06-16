<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $com_id
 * @property string $com_name
 * @property string $com_url
 * @property integer $active
 * @property integer $create
 * @property integer $update
 * @property integer $publish
 * @property integer $lan_id
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $com_img
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_name'], 'required'],
            [['active', 'create', 'update', 'publish', 'lan_id', 'parent_id', 'user_id'], 'integer'],
            [['com_name'], 'string', 'max' => 45],
            [['com_url', 'com_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_name' => 'Com Name',
            'com_url' => 'Com Url',
            'active' => 'Active',
            'create' => 'Create',
            'update' => 'Update',
            'publish' => 'Publish',
            'lan_id' => 'Lan ID',
            'parent_id' => 'Parent ID',
            'user_id' => 'User ID',
            'com_img' => 'Com Img',
        ];
    }
}
