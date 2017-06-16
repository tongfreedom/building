<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $tag_id
 * @property string $tag_name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'TAG ID',
            'tag_name' => 'TAG',
        ];
    }
}
