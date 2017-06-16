<?php
namespace backend\models;

use Yii;

class Mail extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mail';
    }

    public function rules()
    {
        return [
            [['mail_details'], 'string'],
            [['mail_status', 'user_id', 'create', 'update', 'active'], 'integer'],
            [['mail_name', 'mail_email', 'mail_subject'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'mail_id' => 'Mail ID',
            'mail_name' => 'Name',
            'mail_email' => 'Email',
            'mail_subject' => 'Subject',
            'mail_details' => 'Detail',
            'mail_status' => 'Status',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
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

    function status($status) {
        if($status == 1){
          return '<span class="label label-success">Replied</span>';
        }else{
          return '<span class="label label-primary">Wait</span>';
        }
    }

    function replyby($status, $model) {
        if($status == 1){
          return $model->profile->name;
        }else{
          return ' ';
        }
    }
}
