<?php
namespace backend\models;

use Yii;

class Company extends \yii\db\ActiveRecord
{
    public $com_img_old  = null;
    public static function tableName()
    {
        return 'company';
    }

    public function rules()
    {
        return [
            [['com_url'], 'url'],
            [['active', 'create', 'update', 'publish', 'lan_id', 'parent_id', 'user_id'], 'integer'],
            [['com_name'], 'string', 'max' => 45],
            [['com_img'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_name' => 'Name',
            'com_url' => 'URL',
            'active' => 'Active',
            'create' => 'Create',
            'update' => 'Update',
            'publish' => 'Publish',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'user_id' => 'Create by',
            'com_img' => 'Image',
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
