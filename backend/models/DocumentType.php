<?php
namespace backend\models;

use Yii;
use himiklab\sortablegrid\SortableGridBehavior;

class DocumentType extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'doc_type_order'
            ],
        ];
    }

    public static function tableName()
    {
        return 'document_type';
    }

    public function rules()
    {
        return [
            [['doc_type_name', 'type_id'], 'required'],
            [['publish', 'user_id', 'create', 'update', 'lan_id', 'parent_id', 'active', 'type_id','doc_type_order'], 'integer'],
            [['doc_type_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doc_type_id' => 'Document Type ID',
            'doc_type_name' => 'Document Type',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'active' => 'Active',
            'type_id' => 'Type',
            'doc_type_order' => 'No',
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
