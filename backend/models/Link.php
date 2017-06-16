<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class Link extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'link';
    }

    public function behaviors()
    {
       return [
           'sort' => [
               'class' => SortableGridBehavior::className(),
               'sortableAttribute' => 'link_order',
           ],
       ];
    }

    public function rules()
    {
        return [
            [['link_name', 'link_url'], 'required'],
            [['link_url'], 'url'],
            [['link_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['link_name'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'link_name' => 'Name',
            'link_url' => 'URL',
            'link_order' => 'No',
            'publish' => 'Publish',
            'user_id' => 'Create By',
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
