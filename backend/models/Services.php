<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class Services extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'services';
    }

    public function behaviors()
    {
       return [
           'sort' => [
               'class' => SortableGridBehavior::className(),
               'sortableAttribute' => 'service_order',
           ],
       ];
    }

    public function rules()
    {
        return [
            [['service_name'], 'required'],
            [['service_url'], 'url'],
            [['service_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['service_name'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'service_id' => 'Service ID',
            'service_name' => 'Name',
            'service_url' => 'URL',
            'service_order' => 'No',
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
