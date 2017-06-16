<?php
namespace frontend\models;

use Yii;

class Profile extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'profile';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['name', 'public_email', 'gravatar_email', 'location', 'website', 'lastname'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'website' => 'Website',
            'bio' => 'Bio',
            'timezone' => 'Timezone',
            'lastname' => 'Lastname',
        ];
    }

    public function Fullname($model)
    {
        return $model->profile->name.' '.$model->profile->lastname;
    }
}
