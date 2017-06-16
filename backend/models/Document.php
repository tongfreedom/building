<?php
namespace backend\models;

use Yii;

class Document extends \yii\db\ActiveRecord
{
    public  $doc_url_old  = null;

    public static function tableName()
    {
        return 'document';
    }

    public function rules()
    {
        return [
            [['type_id', 'doc_type_id', 'doc_title'], 'required'],
            [['type_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'doc_view','doc_type_id'], 'integer'],
            [['doc_title', 'doc_url'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doc_id' => 'Document ID',
            'doc_title' => 'Title',
            'type_id' => 'Type',
            'doc_url' => 'Document',
            'publish' => 'Public',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'doc_view' => 'Hit',
            'doc_type_id' => 'Document Type',
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

    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['doc_type_id' => 'doc_type_id']);
    }
}
