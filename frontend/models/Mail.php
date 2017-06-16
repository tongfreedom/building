<?php
namespace frontend\models;

use Yii;

class Mail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail';
    }

    /**
     * @inheritdoc
     */
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
            'mail_name' => 'Mail Name',
            'mail_email' => 'Mail Email',
            'mail_subject' => 'Mail Subject',
            'mail_details' => 'Mail Details',
            'mail_status' => 'สถานะ',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }

    public function beforeSave($insert)
    {
          if (parent::beforeSave($insert)) {
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


}
