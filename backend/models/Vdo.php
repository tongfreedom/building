<?php
namespace backend\models;

use Yii;

class Vdo extends \yii\db\ActiveRecord
{
    public $vdo_img_old = null;

    public static function tableName()
    {
        return 'vdo';
    }

    public function rules()
    {
        return [
            [['type_id', 'vdo_title', 'vdo_url'], 'required'],
            [['vdo_url'], 'url'],
            [['vdo_view', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
            [['vdo_title'], 'string', 'max' => 255],
            [['vdo_img','vdo_img_old'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'vdo_id' => 'Video ID',
            'vdo_title' => 'Title',
            'vdo_img' => 'Cover Image',
            'vdo_url' => 'URL',
            'vdo_view' => 'Views',
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
