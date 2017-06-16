<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class Slide extends \yii\db\ActiveRecord
{
    public $slide_img_old  = null,$slide_vdo_old = null;

    public static function tableName()
    {
        return 'slide';
    }

    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'slide_order'
            ],
        ];
    }

    public function rules()
    {
        return [
            [['slide_type', 'slide_title'], 'required'],
            [['slide_link'], 'url'],
            [['slide_view', 'slide_order', 'user_id', 'lan_id', 'parent_id', 'create', 'update', 'active', 'slide_type', 'publish'], 'integer'],
            [['slide_title', 'slide_img'], 'string', 'max' => 45],
            [['slide_vdo'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'slide_id' => 'Slide ID',
            'slide_title' => 'Title',
            'slide_img' => 'Cover Image',
            'slide_link' => 'Link',
            'slide_order' => 'Order',
            'user_id' => 'Create by',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'slide_type' => 'Type',
            'slide_vdo' => 'Slide Video',
            'publish' => 'Publish',
            'slide_view' => 'Hit',
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
