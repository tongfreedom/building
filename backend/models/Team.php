<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class Team extends \yii\db\ActiveRecord
{
    public $team_img_old  = null;

    public static function tableName()
    {
        return 'team';
    }

    public function behaviors()
    {
       return [
           'sort' => [
               'class' => SortableGridBehavior::className(),
               'sortableAttribute' => 'team_order',
           ],
       ];
    }

    public function rules()
    {
        return [
            [['dep_id'],'required'],
            [['team_email'],'email'],
            [['team_order', 'dep_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['dep_id'], 'required'],
            [['team_prefixname', 'team_img', 'team_tel'], 'string', 'max' => 45],
            [['team_firstname', 'team_lastname', 'team_position', 'team_level'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'team_id' => 'Team ID',
            'team_prefixname' => 'Prefix',
            'team_firstname' => 'Firstname',
            'team_lastname' => 'Lastname',
            'team_position' => 'Position',
            'team_level' => 'Level',
            'team_img' => 'Image',
            'team_order' => 'No',
            'team_tel' => 'Tel',
            'team_email' => 'Email',
            'dep_id' => 'Department',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'language',
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

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['dep_id' => 'dep_id']);
    }
}
