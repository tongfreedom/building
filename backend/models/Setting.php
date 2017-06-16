<?php
namespace backend\models;

use Yii;

class Setting extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'setting';
    }

    public function rules()
    {
        return [
            [['st_email'], 'email'],
            [['st_analytic'], 'url'],
            [['active', 'create', 'update', 'user_id'], 'integer'],
            [['st_email', 'st_password', 'st_analytic'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'st_id' => 'Setting ID',
            'st_email' => 'Email',
            'st_password' => 'Password',
            'st_analytic' => 'Analytic',
            'active' => 'Active',
            'create' => 'Create',
            'update' => 'Update',
            'user_id' => 'Create by',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->identity->id;
            if($insert){
                $this->create = Yii::$app->mdate->datesave(date('d/m/Y'));
            }else{
                $this->update = Yii::$app->mdate->datesave(date('d/m/Y'));
            }
            return true;
        } else {
            return false;
        }
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}
