<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class Faq extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'faq';
    }
    
    public function behaviors()
    {
       return [
           'sort' => [
               'class' => SortableGridBehavior::className(),
               'sortableAttribute' => 'faq_order',
           ],
       ];
    }

    public function rules()
    {
        return [
            [['faq_question', 'faq_answer', 'type_id'], 'required'],
            [['faq_question', 'faq_answer'], 'string'],
            [['faq_order', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'faq_id' => 'FAQ ID',
            'faq_question' => 'Question',
            'faq_answer' => 'Answer',
            'faq_order' => 'No',
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
