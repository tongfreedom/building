<?php

namespace backend\models;

use Yii;

class Profile extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%profile}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'name', 'lastname'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['name', 'lastname', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Firstname',
            'lastname' => 'Lastname',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'website' => 'Website',
            'bio' => 'Bio',
            'timezone' => 'Timezone',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
