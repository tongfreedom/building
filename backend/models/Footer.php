<?php
namespace backend\models;

use Yii;

class Footer extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'footer';
    }

    public function rules()
    {
        return [
            [[ 'foot_email'], 'email'],
            [['publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['foot_detail'], 'string'],
            [['foot_address', 'foot_work', 'foot_map'], 'string', 'max' => 255],
            [['foot_tel'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'foot_id' => 'Contact ID',
            'foot_address' => 'Address',
            'foot_tel' => 'Tel',
            'foot_email' => 'Email',
            'foot_work' => 'Worktime',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Langunage',
            'parent_id' => 'Parent',
            'foot_detail' => 'Detail',
            'foot_map' => 'Map',
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
