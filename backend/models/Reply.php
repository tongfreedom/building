<?php
namespace backend\models;

use Yii;

class Reply extends \yii\db\ActiveRecord
{
    public $reply_email = null;

    public static function tableName()
    {
        return 'reply';
    }

    public function rules()
    {
        return [
            [['reply_details'], 'string'],
            [['user_id', 'create', 'update', 'active', 'mail_id'], 'integer'],
            [['reply_subject'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'reply_id' => 'Reply ID',
            'mail_id' => 'Mail',
            'reply_subject' => 'Subject',
            'reply_details' => 'Details',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'reply_email' => 'Email',
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
