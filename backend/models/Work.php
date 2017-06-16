<?php
namespace backend\models;

use Yii;

class Work extends \yii\db\ActiveRecord
{
    public  $tag, $work_img_old  = null;

    public static function tableName()
    {
        return 'work';
    }

    public function rules()
    {
        return [
            [['work_title','type_id'], 'required'],
            [['work_detail'], 'string'],
            [['work_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['work_title'], 'string', 'max' => 255],
            [['work_img'], 'string', 'max' => 45],
            [['tag'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'work_id' => 'Work ID',
            'work_title' => 'Title',
            'work_img' => 'Cover Image',
            'work_detail' => 'Detail',
            'work_view' => 'Views',
            'tag_id' => 'TAG',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'type_id' => 'Type',
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

    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }
}
