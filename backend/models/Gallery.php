<?php
namespace backend\models;

use Yii;

class Gallery extends \yii\db\ActiveRecord
{
    public $tag = null, $gall_img_old = null;

    public static function tableName()
    {
        return 'gallery';
    }

    public function rules()
    {
        return [
            [['gall_title', 'type_id'], 'required'],
            [['gall_detail'], 'string'],
            [['gall_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['gall_title'], 'string', 'max' => 255],
            [['gall_img'], 'string', 'max' => 45],
            [['tag'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'gall_id' => 'Gallery ID',
            'gall_title' => 'Title',
            'gall_img' => 'Cover Image',
            'gall_detail' => 'Detail',
            'gall_view' => 'Views',
            'tag_id' => 'TAG',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'update',
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

    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['gall_id' => 'gall_id']);
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
