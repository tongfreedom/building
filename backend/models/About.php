<?php

namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class About extends \yii\db\ActiveRecord
{
    public  $tag;

    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'about_order'
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%about}}';
    }

    public function rules()
    {
        return [
            [['about_title'], 'required'],
            [['about_detail'], 'string'],
            [['about_view', 'about_order', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['about_title'], 'string', 'max' => 255],
            [['tag'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'about_id' => 'About ID',
            'about_title' => 'Title',
            'about_detail' => 'Detail',
            'about_view' => 'Views',
            'about_order' => 'No',
            'tag_id' => 'TAG',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
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
